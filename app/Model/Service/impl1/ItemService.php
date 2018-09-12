<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 16:13
 */

namespace App\Model\Service;


use App\Model\Dao\IItemDAO;
use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Enum\ItemType;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\NotFoundException;
use App\Model\Filter\ItemFilter;
use DateTime;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ItemService implements IItemService
{
	//tolerance to identify same items received to create from client
	const SECONDS = 10;

	/** @var IItemDAO */
	protected $itemDao;

	/** @var IWalletService */
	protected $walletService;

	/** @var IMemberService */
	protected $memberService;

	/** @var IPurposeService */
	protected $purposeService;

	/**	@var ICurrencyService */
	protected $currencyService;

	/** @var ITranslationService */
	protected $translationService;

	/**
	 * ItemService constructor.
	 * @param IItemDAO $itemDAO
	 * @param IWalletService $walletService
	 * @param IMemberService $memberService
	 * @param IPurposeService $purposeService
	 * @param ICurrencyService $currencyService
	 * @param ITranslationService $translationService
	 */
	public function __construct(
		IItemDAO $itemDAO,
		IWalletService $walletService,
		IMemberService $memberService,
		IPurposeService $purposeService,
		ICurrencyService $currencyService,
		ITranslationService $translationService
	) {
		$this->itemDao = $itemDAO;
		$this->walletService = $walletService;
		$this->memberService = $memberService;
		$this->purposeService = $purposeService;
		$this->currencyService = $currencyService;
		$this->translationService = $translationService;
	}


	/** @inheritdoc */
	public function getWalletItems(int $walletId, Member $member, ?ItemFilter $filter = NULL): array {
		//test if member is owner
		$this->walletService->getWallet($walletId, $member);

		if ($filter === null) {
		    $filter = (new ItemFilter())->setWalletId($walletId)->setMember($member);
        }
		return $this->itemDao->findByFilter($filter);
	}

	/** @inheritdoc */
    public function getMembersItems(Member $member): array {
	    return $this->itemDao->findByColumn('MemberID', $member->getId());
    }


    /** @inheritdoc */
    public function getMonthStatistics(Member $member, int $walletId, $purposes = NULL): array {
		$wallet = $this->walletService->getWallet($walletId, $member);
		$startYear = $wallet->getCreated()->format('Y');
		$startMonth = $wallet->getCreated()->format('m');
		$thisYear = (new DateTime())->format('Y');
		$thisMonth = (new DateTime())->format('m');

		//get values for previous months
		list($monthStats, $_monthStat) = $this->fillMonths($walletId, $purposes, $startYear, $startMonth, $thisYear, $thisMonth, TRUE);
		list($minEx, $maxEx, $averageEx, $sum) = $this->getMonthExtremes($monthStats);
		$ret['full'] = [
			"months" => $monthStats,
			"thisMonth" => $_monthStat,
			"average" => $averageEx,
			"min" => $minEx,
			"max" => $maxEx,
			"items" => count($monthStats),
			"totalExpense" => $sum,
		];

		list($monthStats, $_monthStat) = $this->fillMonths($walletId, $purposes, $startYear, $startMonth, $thisYear, $thisMonth, FALSE);
		list($minEx, $maxEx, $averageEx, $sum) = $this->getMonthExtremes($monthStats);
		$ret['part'] = [
			"months" => $monthStats,
			"thisMonth" => $_monthStat,
			"average" => $averageEx,
			"min" => $minEx,
			"max" => $maxEx,
			"items" => count($monthStats),
			"totalExpense" => $sum,
		];

		return $ret;
	}


    /** @inheritdoc */
    public function priceByFilter(Member $member, ItemFilter $filter): float {
        $items = $this->getWalletItems($filter->getWalletId(), $member, $filter);
        $price = 0;
        foreach ($items as $item)
            $price += $item->getPrice() * $item->getCourse();
        return $price;
    }



    /** @inheritdoc */
    public function getItem(int $id): Item {
		if ($id < 1)
			throw new BadParameterException('Exception.BadParameter.SmallerThan1', 'Identifier smaller than 1');
		$item = $this->itemDao->findOne($id);
		if ($item == NULL)
            throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Item']);
		return $item;
	}

    /** @inheritdoc */
    public function createItem(Member $member, array $data): Item {
		$item = new Item();
		$this->setItem($item, $data);
		$this->checkForItemExistence($item);

		if ($item->isVyber()) {
			$item->setOdepsat(FALSE)->setNote(NULL)->setIncome(TRUE)->setType(ItemType::CASH)->setName('Výběr');
		}
		$item = $this->itemDao->create($item);
		return $item;
	}

    /** @inheritdoc */
    public function checkItem(Member $member, int $id): int {
		try {
			$item = $this->getItem($id);
			if ($item->getMember()->getId() != $member->getId())
				throw (new AuthenticationException('Exception.UserNotOwner', 'User is not owner of this :entity'))->setBind(['entity' => 'item']);

			$item->setActive(FALSE);
			$this->itemDao->update($item);
			return $id;
		} catch (NotFoundException $ex) {
            throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Item']);
		}
	}

    /** @inheritdoc */
    public function checkAll(int $walletId, Member $member, ItemFilter $filter): int {
		//checks if member is owner of wallet
		$this->walletService->getWallet($walletId, $member);
//		$notes = array_filter($notes, function($a){
//			return $a != "";
//		});
		$filter->setVyber(FALSE)->setIncome(FALSE)->setActive(TRUE);

		$items = $this->itemDao->findByFilter($filter);

		foreach ($items as $item) {
			$item->setActive(FALSE);
			$this->itemDao->update($item);
		}
		return count($items);
	}

    /** @inheritdoc */
    public function updateItem(Member $member, int $id, array $data): Item {
		$item = $this->getItem($id);
		$this->setItem($item, $data, FALSE);
		$item = $this->itemDao->update($item);
		return $item;
	}

    /** @inheritdoc */
    public function deleteItem(Member $member, int $id): int {
		try {
			$item = $this->getItem($id);
			$this->itemDao->delete($item);
			return $id;
		} catch (NotFoundException $ex) {
            throw (new NotFoundException('Exception.NotFound', 'No :entity found.'))->setBind(['entity' => 'Item']);
		}
	}

    /** @inheritdoc */
    public function format(Item $item, Member $member): array {
		$ret = [];

		$ret['id'] = $item->getId();
		$ret['name'] = $item->getName();
		$ret['description'] = $item->getDescription();
		$ret['price'] = $item->getPrice();
		$ret['course'] = $item->getCourse();
		$ret['date'] = $item->getDate()->format('Y-m-d H:i:s'); //date
		$ret['active'] = $item->isActive();
		$ret['type'] = $item->getType();
		$ret['odepsat'] = $item->isOdepsat();
		$ret['vyber'] = $item->isVyber();
		$ret['income'] = $item->isIncome();
		$ret['note'] = $item->getNote() ? $this->purposeService->format($item->getNote(), $member) : NULL ;
		$ret['currency'] = $this->currencyService->format($item->getCurrency());
		$ret['member'] = $item->getMember()->getLogin();
		$ret['wallet'] = $item->getWallet()->getId();

		return $ret;
	}

    /** @inheritdoc */
    public function formatEntities(array $items, Member $member): array {
		$ret = [];
		foreach ($items as $item) {
			$ret[] = self::format($item, $member);
		}
		return $ret;
	}

    /** @inheritdoc */
    public function count(ItemFilter $filter): int {
        return $this->itemDao->count($filter);
    }







	/**
	 * @param Item $entity
	 * @param mixed $data
	 * @param bool $newEntity setting new entity
	 * @throws BadRequestException
	 * @throws NotFoundException
     * @throws BadParameterException
     * @throws AuthenticationException
	 */
	protected function setItem(Item $entity, array $data, ?bool $newEntity = TRUE) {

		if (!isset($data['name']) || $data['name'] == NULL)
            throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'name']);

		if (!isset($data['price']) || $data['price'] == NULL)
            throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'price']);

		if (!isset($data['date']) || $data['date'] == NULL)
            throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'date']);


		if ($newEntity) {
			if (!isset($data['member']) || $data['member'] == NULL)
                throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'Member("login")']);

			if (!isset($data['currency']) || $data['currency'] == NULL || !isset($data['currency']['code']) || $data['currency']['code'] == "")
                throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'Currency("code")']);

			if (
				(!isset($data['note']) || $data['note'] == NULL || !isset($data['note']['id']) || $data['note']['id'] == "")
				&& (!isset($data['income']) || !$data['income'])
			) throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'Note("id")']);

			if (!isset($data['wallet']) || $data['wallet'] == NULL)
                throw (new BadRequestException('Exception.Parameter.Missing', ':parameter missing'))->setBind(['parameter' => 'Wallet("id")']);
		}


		$entity->setName(str_replace(';', ':', str_replace("\n", ' ', $data['name'])));
		$entity->setPrice($data['price']);
		$entity->setDate(new DateTime($data['date']));
		if (isset($data['course'])) $entity->setCourse($data['course']);
		if (isset($data['description'])) {
			$description = str_replace(';', '', str_replace("\n", ' ', $data['description']));
			$entity->setDescription($description);
		}
		else $entity->setDescription('');
		if (isset($data['income'])) $entity->setIncome($data['income']);
		if (isset($data['active'])) $entity->setActive($data['active']);
		if (isset($data['type'])) $entity->setType($data['type']);
		if (isset($data['vyber'])) $entity->setVyber($data['vyber']);
		if (isset($data['odepsat'])) $entity->setOdepsat($data['odepsat']);

		
		if (isset($data['member']) && $data['member']) {
			try {
				$entity->setMember($this->memberService->getMemberByColumn('login', $data['member']));
			} catch (NotFoundException $ex) {
				throw (new NotFoundException('Exception.NotFoundByParameter', 'No :entity with given :parameter', 0, $ex))->setBind(['entity' => 'Member', 'parameter' => 'login']);
			}
		}
		if (isset($data['currency']['code']) && $data['currency']['code']) {
			try {
				$entity->setCurrency($this->currencyService->getCurrencyByColumn('code', $data['currency']['code']));
			} catch (NotFoundException $ex) {
                throw (new NotFoundException('Exception.NotFoundByParameter', 'No :entity with given :parameter', 0, $ex))->setBind(['entity' => 'Currency', 'parameter' => 'currencyId']);
			}
		}
		if (isset($data['note']['id']) && $data['note']['id']) {
			try {
				$entity->setNote($this->purposeService->getPurpose($data['note']['id']));
			} catch (NotFoundException $ex) {
                throw (new NotFoundException('Exception.NotFoundByParameter', 'No :entity with given :parameter', 0, $ex))->setBind(['entity' => 'Note', 'parameter' => 'id']);
			}
		}
		if (isset($data['wallet']) && $data['wallet']) {
			try {
				$entity->setWallet($this->walletService->getWallet($data['wallet'], $entity->getMember()));
			} catch (NotFoundException $ex) {
                throw (new NotFoundException('Exception.NotFoundByParameter', 'No :entity with given :parameter', 0, $ex))->setBind(['entity' => 'Wallet', 'parameter' => 'id']);
			}
		}
	}



	/**
	 * @param Item $item
     * @throws AlreadyExistException
     * @throws BadParameterException
	 */
	protected function checkForItemExistence(Item $item) {
		$member = $item->getMember();
		$i = $this->itemDao->findUserLastItem($member);
		if (!$i) return;

		$message = $this->translationService->getTranslation('AddItem.Form.Duplicity', $member->getLanguage()->getCode(), 'Item already exists')->getValue();
		if ($i->getName() == $item->getName()
			&& $i->getDescription() == $item->getDescription()
			&& $i->getPrice() == $item->getPrice()
			&& $i->getCourse() == $item->getCourse()
			&& $i->getType() == $item->getType()
			&& $i->isVyber() == $item->isVyber()
			&& $i->isOdepsat() == $item->isOdepsat()
			&& $i->getWallet()->getId() == $item->getWallet()->getId()
			&& abs($item->getDate()->getTimestamp() - $i->getDate()->getTimestamp()) < self::SECONDS
		) {
			throw new AlreadyExistException($message);
		}
	}


	/**
	 * @param int $walletId
	 * @param string $purposes
	 * @param int $startYear
	 * @param string $startMonth
	 * @param int $thisYear
	 * @param string $thisMonth
	 * @param bool $wholeMonth
	 * @return array
	 */
	private function fillMonths(int $walletId, string $purposes, int $startYear, string $startMonth, int $thisYear, string $thisMonth, bool $wholeMonth = TRUE): array {
		$monthStats = [];
		$_monthStat = null;
		for ($_year = $startYear; $_year <= $thisYear; $_year++) {
			for ($_month = $_year == $startYear ? $startMonth : '01'; $_month <= '12'; $_month++) {
				if (strlen($_month) == 1) $_month = '0' . $_month;

				$filters = new ItemFilter();
				$filters->setWalletId($walletId)->setYear($_year)->setMonth($_month)->setActive(NULL);
				if ($purposes) $filters->setNotes($purposes);
				$expenses = $this->itemDao->findByFilter($filters);
				$filters->setIncome(TRUE);
				$incomes = $this->itemDao->findByFilter($filters);

				if (!$wholeMonth) {
					foreach ($incomes as $key => $income) {
						if ($income->getDate()->format('d') > (new \DateTime())->format('d'))
							unset($incomes[$key]);
					}
					foreach ($expenses as $key => $expense) {
						if ($expense->getDate()->format('d') > (new \DateTime())->format('d'))
							unset($expenses[$key]);
					}
				}

				$incomesValue = 0.0;
				foreach ($incomes as $income) {
					$incomesValue += $income->getPrice() * $income->getCourse();
				}
				$expensesValue = 0.0;
				foreach ($expenses as $expense) {
					$expensesValue += $expense->getPrice() * $expense->getCourse();
				}

				$_monthStat = [
					"month" => $_month,
					"year" => $_year,
					"income" => $incomesValue,
					"incomesCnt" => count($incomes),
					"expense" => $expensesValue,
					"expensesCnt" => count($expenses),
				];
				if ($_year == $thisYear && $_month == $thisMonth) { break; }
				$monthStats[] = $_monthStat;
			}
		}
		return [$monthStats, $_monthStat];
	}


	/**
	 * @param array $monthStats
	 * @return array
	 */
	private function getMonthExtremes(array $monthStats): array {
		//get min, max and average
		$minEx['expense'] = PHP_INT_MAX;
		$maxEx['expense'] = $acc = 0;
		foreach ($monthStats as $monthStat) {
			$minEx = $monthStat['expense'] < $minEx['expense'] && $monthStat['expense'] > 0 ? $monthStat : $minEx;
			$maxEx = $maxEx['expense'] > $monthStat['expense'] ? $maxEx : $monthStat;
			$acc += $monthStat['expense'];
		}
		$minEx = $minEx['expense'] == PHP_INT_MAX ? ['expense' => 0] : $minEx;
		$averageEx = count($monthStats) ? $acc / count($monthStats) : 0;
		return [$minEx, $maxEx, $averageEx, $acc];
	}
}

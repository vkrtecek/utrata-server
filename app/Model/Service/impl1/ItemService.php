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
use App\Model\Enum\ItemState;
use App\Model\Enum\ItemType;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Filter\ItemFilter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use DateTime;

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


	/**
	 * @param int $walletId
	 * @param Member $member
	 * @param int $state
	 * @param string $month
	 * @param string $notes
	 * @param string $year
	 * @param string $pattern
	 * @param string $orderBy
	 * @param string $orderHow
	 * @param int $limit
	 * @return Item[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getWalletItems($walletId, Member $member, $state, $month, $notes, $year, $pattern, $orderBy, $orderHow, $limit){
		if ($state == NULL) $state = ItemState::UNCHECKED;
		if (!$walletId)
			throw new BadRequestHttpException('ItemService: "walletId" missing');

		$filters = (new ItemFilter())->setWalletId($walletId)->setMonth($month)
			->setNotes($notes)->setYear($year)->setPattern($pattern)
			->setOrderBy($orderBy)->setOrderHow($orderHow)->setLimit($limit);
		switch ($state) {
			case ItemState::UNCHECKED:
				$filters->setActive(TRUE)->setVyber(FALSE)->setIncome(FALSE);
				break;
			case ItemState::CHECKED:
				$filters->setActive(FALSE)->setVyber(FALSE)->setIncome(FALSE);
				break;
			case ItemState::INCOMES:
				$filters->setIncome(TRUE);//->setVyber(FALSE);
				break;
			case ItemState::ALL:
				$filters->setVyber(FALSE);
				break;
			default:
				throw new BadParameterException('ItemService: Bad ItemState.');
		}

		$items = $this->itemDao->findByFilter($filters);
		if (!count($items))
			throw new NotFoundException('ItemService: No item found.');

		return $items;
	}


	/**
	 * @param Member $member
	 * @param int $walletId
	 * @param string $purposes expected in form like "1,3,5,7"
	 * @return array
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getMonthStatistics(Member $member, $walletId, $purposes = NULL) {
		$wallet = $this->walletService->getWallet($walletId, $member);
		$startYear = $wallet->getCreated()->format('Y');
		$startMonth = $wallet->getCreated()->format('m');
		$thisYear = (new DateTime())->format('Y');
		$thisMonth = (new DateTime())->format('m');

		//get values for previous months
		list($monthStats, $_monthStat) = $this->fillMonths($walletId, $purposes, $startYear, $startMonth, $thisYear, $thisMonth, TRUE);
		list($minEx, $maxEx, $averageEx, $sum) = $this->getMonthExtremes($monthStats);
		$ret['full'] = [
			//TODO note
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
			//TODO note
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



	/**
	 * @param int $id
	 * @return Item
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getItem($id) {
		if ((string)((int)$id) != $id || (int)$id < 1)
			throw new BadParameterException('ItemService: Identifier not Integer or smaller than 1');
		$item = $this->itemDao->findOne($id);
		if ($item == NULL)
			throw new NotFoundException('ItemService: No Item found.');
		return $item;
	}

	/**
	 * @param Member $member
	 * @param $data
	 * @return Item
	 * @throws BadRequestHttpException
	 * @throws AlreadyExistException
	 * @throws NotFoundException
	 */
	public function createItem(Member $member, $data) {
		$item = new Item();
		$this->setItem($item, $data);
		$this->checkForItemExistence($item);

		if ($item->isVyber()) {
			$item->setOdepsat(FALSE)->setNote(NULL)->setIncome(TRUE)->setType(ItemType::CASH)->setName('Výběr');
		}
		$item = $this->itemDao->create($item);
		return $item;
	}

	/**
	 * @param Member $member
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function checkItem(Member $member, $id) {
		try {
			$item = $this->getItem($id);
			if ($item->getMember()->getId() != $member->getId())
				throw new AuthenticationException('User is not owner of this item');

			$item->setActive(FALSE);
			$this->itemDao->update($item);
			return $id;
		} catch (NotFoundException $ex) {
			throw new NotFoundException('ItemService: No Item with given id.');
		}
	}

	/**
	 * @param int $walletId
	 * @param Member $member
	 * @param string $month
	 * @param string $notes
	 * @param string $year
	 * @param string $pattern
	 * @param string $orderBy
	 * @param string $orderHow
	 * @param int $limit
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function checkAll($walletId, Member $member, $month, $notes, $year, $pattern, $orderBy, $orderHow, $limit) {
		if (!$walletId)
			throw new BadRequestHttpException('ItemService: "walletId" missing');
		//checks if member is owner of wallet
		$this->walletService->getWallet($walletId, $member);
		$notes = array_filter($notes, function($a){
			return $a != "";
		});
		$filters = (new ItemFilter())->setWalletId($walletId)->setMonth($month)
			->setNotes($notes)->setYear($year)->setPattern($pattern)
			->setOrderBy($orderBy)->setOrderHow($orderHow)->setLimit($limit)
			->setVyber(FALSE)->setIncome(FALSE)->setActive(TRUE);

		$items = $this->itemDao->findByFilter($filters);
		if (!count($items))
			throw new NotFoundException('ItemService: No item found.');

		foreach ($items as $item) {
			$item->setActive(FALSE);
			$this->itemDao->update($item);
		}
		return count($items);
	}

	/**
	 * @param Member $member
	 * @param int $id
	 * @param $data
	 * @return Item
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateItem(Member $member, $id, $data) {
		$item = $this->itemDao->findOne($id);
		$this->setItem($item, $data, FALSE);
		$item = $this->itemDao->update($item);
		return $item;
	}

	/**
	 * @param Member $member
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteItem(Member $member, $id) {
		try {
			$item = $this->getItem($id);
			$this->itemDao->delete($item);
			return $id;
		} catch (NotFoundException $ex) {
			throw new NotFoundException('ItemService: No Item with given id.');
		}
	}

	/**
	 * @param Item $item
	 * @return array
	 */
	public function format(Item $item) {
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
		$ret['note'] = $item->getNote() ? $this->purposeService->format($item->getNote()) : NULL ;
		$ret['currency'] = $this->currencyService->format($item->getCurrency());
		$ret['member'] = $item->getMember()->getLogin();
		$ret['wallet'] = $item->getWallet()->getId();

		return $ret;
	}

	/**
	 * @param Item[] $items
	 * @return array
	 */
	public function formatEntities($items) {
		$ret = [];
		foreach ($items as $item) {
			$ret[] = self::format($item);
		}
		return $ret;
	}







	/**
	 * @param Item $entity
	 * @param mixed $data
	 * @param bool $newEntity setting new entity
	 * @throws BadRequestHttpException
	 * @throws NotFoundException
	 */
	protected function setItem(Item $entity, $data, $newEntity = TRUE) {
		if ($newEntity) {
			if (!isset($data['member']) || $data['member'] == NULL)
				throw new BadRequestHttpException('ItemService: Member("login") must be specified.');

			if (!isset($data['currency']) || $data['currency'] == NULL || !isset($data['currency']['code']) || $data['currency']['code'] == "")
				throw new BadRequestHttpException('ItemService: Currency("currencyCode") must be specified.');

			if (
				(!isset($data['note']) || $data['note'] == NULL || !isset($data['note']['id']) || $data['note']['id'] == "")
				&& (!isset($data['income']) || !$data['income'])
			) throw new BadRequestHttpException('ItemService: Note("id") must be specified.');

			if (!isset($data['wallet']) || $data['wallet'] == NULL)
				throw new BadRequestHttpException('ItemService: Wallet("id") must be specified.');

			if (!isset($data['name']) || $data['name'] == NULL)
				throw new BadRequestHttpException('ItemService: "name" must be specified.');

			if (!isset($data['price']) || $data['price'] == NULL)
				throw new BadRequestHttpException('ItemService: "price" must be specified.');

			if (!isset($data['date']) || $data['date'] == NULL)
				throw new BadRequestHttpException('ItemService: "date" must be specified.');
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
				throw new NotFoundException('ItemService: No Member with given login.', 0, $ex);
			}
		}
		if (isset($data['currency']['code']) && $data['currency']['code']) {
			try {
				$entity->setCurrency($this->currencyService->getCurrencyByColumn('code', $data['currency']['code']));
			} catch (NotFoundException $ex) {
				throw new NotFoundException('ItemService: No Currency with given currencyId.', 0, $ex);
			}
		}
		if (isset($data['note']['id']) && $data['note']['id']) {
			try {
				$entity->setNote($this->purposeService->getPurpose($data['note']['id']));
			} catch (NotFoundException $ex) {
				throw new NotFoundException('ItemService: No Note with given id.', 0, $ex);
			}
		}
		if (isset($data['wallet']) && $data['wallet']) {
			try {
				$entity->setWallet($this->walletService->getWallet($data['wallet'], $entity->getMember()));
			} catch (NotFoundException $ex) {
				throw new NotFoundException('ItemService: No Wallet with given id.', 0, $ex);
			}
		}
	}



	/**
	 * @param Item $item
	 * @throws AlreadyExistException
	 */
	protected function checkForItemExistence(Item $item) {
		$member = $item->getMember();
		$i = $this->itemDao->findUserLastItem($member);

		$message = $this->translationService->getTranslation('AddItem.Form.Duplicity', $member->getLanguage()->getCode())->getValue();
		$message = $message == "" ? 'Item already exists' : $message;
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
	private function fillMonths($walletId, $purposes, $startYear, $startMonth, $thisYear, $thisMonth, $wholeMonth = TRUE) {
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
	private function getMonthExtremes($monthStats) {
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
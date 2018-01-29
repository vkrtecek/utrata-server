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
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Filter\ItemFilter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use DateTime;

class ItemService implements IItemService
{
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

	/**
	 * ItemService constructor.
	 * @param IItemDAO $itemDAO
	 * @param IWalletService $walletService
	 * @param IMemberService $memberService
	 * @param IPurposeService $purposeService
	 * @param ICurrencyService $currencyService
	 */
	public function __construct(
		IItemDAO $itemDAO,
		IWalletService $walletService,
		IMemberService $memberService,
		IPurposeService $purposeService,
		ICurrencyService $currencyService
	) {
		$this->itemDao = $itemDAO;
		$this->walletService = $walletService;
		$this->memberService = $memberService;
		$this->purposeService = $purposeService;
		$this->currencyService = $currencyService;
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
	 * @return Item[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getWalletItems($walletId, Member $member, $state, $month, $notes, $year, $pattern, $orderBy, $orderHow){
		if ($state == NULL) $state = ItemState::UNCHECKED;
		if (!$walletId)
			throw new BadRequestHttpException('ItemService: "walletId" missing');

		$notes = explode(',', $notes);
		$filters = (new ItemFilter())->setWalletId($walletId)->setMonth($month)
			->setNotes($notes)->setYear($year)->setPattern($pattern)
			->setOrderBy($orderBy)->setOrderHow($orderHow);

		$items = $this->itemDao->findByFilter($filters);
		if (!count($items))
			throw new NotFoundException('ItemService: No item found.');

		$ret = [];
		switch ($state) {
			case ItemState::UNCHECKED:
				foreach ($items as $item)
					if ($item->isActive() && !$item->isVyber() && !$item->isIncome())
						$ret[] = $item;
				break;
			case ItemState::CHECKED:
				foreach ($items as $item)
					if (!$item->isActive() && !$item->isVyber() && !$item->isIncome())
						$ret[] = $item;
				break;
			case ItemState::INCOMES:
				foreach ($items as $item)
					if (!$item->isVyber() && $item->isIncome())
						$ret[] = $item;
				break;
			case ItemState::ALL:
				foreach ($items as $item)
					$ret[] = $item;
				break;
			default:
				throw new BadParameterException('ItemService: Bad ItemState.');
		}

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
	 * @param $data
	 * @return Item
	 * @throws BadRequestHttpException
	 */
	public function createItem($data) {}

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function checkItem($id) {
		try {
			$item = $this->getItem($id);
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
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function checkAll($walletId, Member $member, $month, $notes, $year, $pattern, $orderBy, $orderHow) {
		$state = ItemState::UNCHECKED;
		if (!$walletId)
			throw new BadRequestHttpException('ItemService: "walletId" missing');
		$notes = array_filter($notes, function($a){
			return $a != "";
		});
		$filters = (new ItemFilter())->setWalletId($walletId)->setMonth($month)
			->setNotes($notes)->setYear($year)->setPattern($pattern)
			->setOrderBy($orderBy)->setOrderHow($orderHow);

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
	 * @param int $id
	 * @param $data
	 * @return Item
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateItem($id, $data) {}

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteItem($id) {
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
	public static function format(Item $item) {
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
		$ret['note'] = $item->getNote() ? $item->getNote()->getValue() : NULL ;
		$ret['currency'] = $item->getCurrency()->getValue();
		$ret['member'] = $item->getMember()->getLogin();
		$ret['wallet'] = $item->getWallet()->getId();

		return $ret;
	}

	/**
	 * @param Item[] $items
	 * @return array
	 */
	public static function formatEntites($items) {
		$ret = [];
		foreach ($items as $item)
			$ret[] = self::format($item);
		return $ret;
	}







	/**
	 * @param Item $entity
	 * @param mixed $data
	 * @param bool $newEntity
	 * @throws BadRequestHttpException
	 * @throws NotFoundException
	 */
	protected function setItem(Item $entity, $data, $newEntity = TRUE) {
		if ($newEntity) {
			if (!isset($data['member']) || $data['member'] == NULL)
				throw new BadRequestHttpException('ItemService: Member("login") must be specified.');

			if (!isset($data['currency']) || $data['currency'] == NULL)
				throw new BadRequestHttpException('ItemService: Currency("currencyId") must be specified.');

			if (!isset($data['note']) || $data['note'] == NULL)
				throw new BadRequestHttpException('ItemService: Note("id") must be specified.');

			if (!isset($data['wallet']) || $data['wallet'] == NULL)
				throw new BadRequestHttpException('ItemService: Wallet("id") must be specified.');

			if (!isset($data['name']) || $data['name'] == NULL)
				throw new BadRequestHttpException('ItemService: "name" must be specified.');

			if (!isset($data['price']) || $data['price'] == NULL)
				throw new BadRequestHttpException('ItemService: "price" must be specified.');

			if (!isset($data['date']) || $data['date'] == NULL)
				throw new BadRequestHttpException('ItemService: "date" must be specified.');
		}
		

		if (isset($data['name'])) $entity->setName($data['name']);
		if (isset($data['price'])) $entity->setPrice($data['price']);
		if (isset($data['date'])) $entity->setDate(new DateTime($data['date']));
		if (isset($data['course'])) $entity->setCourse($data['course']);
		if (isset($data['description'])) $entity->setDescription($data['description']);
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
		if (isset($data['currency']) && $data['currency']) {
			try {
				$entity->setCurrency($this->currencyService->getCurrencyByColumn('code', $data['currency']));
			} catch (NotFoundException $ex) {
				throw new NotFoundException('ItemService: No Currency with given currencyId.', 0, $ex);
			}
		}
		if (isset($data['note']) && $data['note']) {
			try {
				$entity->setNote($this->purposeService->getPurpose($data['note']));
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
}
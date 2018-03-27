<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 8:17
 */

namespace Tests\Fake\Dao;


use App\Model\Dao\IItemDAO;
use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Enum\ItemType;
use App\Model\Exception\IntegrityException;
use App\Model\Filter\ItemFilter;
use Tests\Fake\Service\FakeCurrencyService;
use Tests\Fake\Service\FakeMemberService;
use Tests\Fake\Service\FakePurposeService;
use Tests\Fake\Service\FakeWalletService;

class FakeItemDAO implements IItemDAO
{
	/** @var Item */
	private $item;
	/** @var Item */
	private $item2;
	/** @var Item */
	private $item3;

	/** @var Member */
	private $member;

	public function __construct() {
		$this->member = (new FakeMemberService())->getMember('vojta');

		$i = new Item();
		$i->setId(1);
		$i->setName('some name');
		$i->setDescription('some desc');
		$i->setPrice(100);
		$i->setCourse(1);
		$i->setDate(new \DateTime('2016-01-26 21:35:21'));
		$i->setCreated(new \DateTime('2018-03-26 21:35:21'));
		$i->setType(ItemType::CARD);
		$i->setActive(TRUE);
		$i->setIncome(FALSE);
		$i->setVyber(FALSE);
		$i->setOdepsat(FALSE);
		$i->setNote((new FakePurposeService())->getPurpose(1));
		$i->setCurrency((new FakeCurrencyService())->getCurrency(1));
		$i->setWallet((new FakeWalletService())->getWallet(1, $this->member));
		$i->setMember((new FakeMemberService())->getMember('vojta'));
		$this->item = $i;

		$i = new Item();
		$i->setId(2);
		$i->setName('another name');
		$i->setDescription('another desc');
		$i->setPrice(500);
		$i->setCourse(2.5);
		$i->setDate(new \DateTime('2016-01-26 21:35:21'));
		$i->setCreated(new \DateTime('2018-03-26 21:35:21'));
		$i->setModified(new \DateTime('2018-03-26 21:35:21'));
		$i->setType(ItemType::CASH);
		$i->setActive(TRUE);
		$i->setIncome(TRUE);
		$i->setVyber(FALSE);
		$i->setOdepsat(FALSE);
		$i->setNote((new FakePurposeService())->getPurpose(3));
		$i->setCurrency((new FakeCurrencyService())->getCurrency(1));
		$i->setWallet((new FakeWalletService())->getWallet(1, $this->member));
		$i->setMember((new FakeMemberService())->getMember('vojta'));
		$this->item2 = $i;

		$i2 = new Item();
		$i2->setId(3);
		$i2->setName('another name');
		$i2->setDescription('another desc');
		$i2->setPrice(500);
		$i2->setCourse(2.5);
		$i2->setDate(new \DateTime('2016-01-26 21:35:21'));
		$i2->setCreated(new \DateTime('2018-03-26 21:35:21'));
		$i2->setModified(new \DateTime('2018-03-26 21:35:21'));
		$i2->setType(ItemType::CASH);
		$i2->setActive(TRUE);
		$i2->setVyber(TRUE);
		$i2->setIncome(FALSE);
		$i2->setOdepsat(FALSE);
		$i2->setNote((new FakePurposeService())->getPurpose(3));
		$i2->setCurrency((new FakeCurrencyService())->getCurrency(1));
		$i2->setWallet((new FakeWalletService())->getWallet(1, $this->member));
		$i2->setMember((new FakeMemberService())->getMember('vojta'));
		$this->item3 = $i2;
	}

	/**
	 * @return Item[]|NULL
	 */
	public function findAll() {
		return [
			$this->item,
			$this->item2,
			$this->item3,
		];
	}

	/**
	 * @param int $id
	 * @return Item|NULL
	 */
	public function findOne($id) {
		if ($id > 50) return NULL;
		return $this->findAll()[$id % 3];
	}

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Item[]|NULL
	 */
	public function findByColumn($key, $val) {}

	/**
	 * @param ItemFilter $filters
	 * @return Item[]
	 */
	public function findByFilter(ItemFilter $filters) {
		return $this->findAll();
	}

	/**
	 * @param ItemFilter $filter
	 * @return Item[]
	 */
	public function findUsersItemsByNotes(ItemFilter $filter) {}

	/**
	 * @param Member $member
	 * @return Item[]|NULL
	 */
	public function findUserItems(Member $member) {}

	/**
	 * @param Member $member
	 * @return Item
	 */
	public function findUserLastItem(Member $member) {}

	/**
	 * @param Item $item
	 * @return Item
	 */
	public function create(Item $item) {
		return $item;
	}

	/**
	 * @param Item $item
	 * @return Item
	 */
	public function update(Item $item) {
		return $item;
	}

	/**
	 * @param Item $item
	 * @throws IntegrityException
	 */
	public function delete(Item $item) {}

	/**
	 * @param Item $item
	 * @return Item|NULL
	 */
	public function checkExistence(Item $item) {}
}
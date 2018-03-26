<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 25. 3. 2018
 * Time: 23:55
 */

namespace Tests\Fake\Dao;


use App\Model\Dao\IWalletDAO;
use App\Model\Entity\CheckState;
use App\Model\Entity\Item;
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemType;
use App\Model\Exception\IntegrityException;
use Tests\Fake\Service\FakeCheckStateService;
use Tests\Fake\Service\FakeMemberService;

class FakeWalletDAO implements IWalletDAO
{
	/** @var Wallet */
	protected $wallet1;
	/** @var Wallet */
	protected $wallet2;

	/** @var CheckState */
	protected $cs1;
	/** @var CheckState */
	protected $cs2;

	public function __construct() {
		$this->wallet1 = new Wallet();
		$this->wallet1->setName('wallet name 1');
		$this->wallet1->setCreated(new \DateTime());
		$this->wallet1->setMember((new FakeMemberService())->getMember('vojta'));
		$this->wallet2 = new Wallet();
		$this->wallet2->setName('wallet name 2');
		$this->wallet2->setCreated(new \DateTime());
		$this->wallet2->setMember((new FakeMemberService())->getMember('jožka'));

		$this->cs1 = (new FakeCheckStateService())->getWalletCheckState($this->wallet1, ItemType::CARD);
		$this->cs2 = (new FakeCheckStateService())->getWalletCheckState($this->wallet1, ItemType::CASH);
	}

	/**
	 * @return Wallet[]|NULL
	 */
	public function findAll() {
		return [ $this->wallet1, $this->wallet2 ];
	}

	/**
	 * @param int $id
	 * @return Wallet|NULL
	 */
	public function findOne($id) {
		return $this->wallet1;
	}

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Wallet[]
	 */
	public function findByColumn($key, $val) {
		return $this->findAll();
	}

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Wallet
	 */
	public function findOneByColumn($key, $val) {
		return $this->wallet1;
	}

	/**
	 * @param Wallet $wallet
	 * @return Item[]
	 */
	public function getItems(Wallet $wallet) {
		return [];
	}

	/**
	 * @param Wallet $wallet
	 * @return CheckState[]
	 */
	public function getCheckStates(Wallet $wallet) {
		return [
			$this->cs1,
			$this->cs2
		];
	}

	/**
	 * @param Wallet $wallet
	 * @return Wallet
	 */
	public function create(Wallet $wallet) {
		return $wallet->setCreated(new \DateTime());
	}

	/**
	 * @param Wallet $wallet
	 * @return Wallet
	 */
	public function update(Wallet $wallet) {
		return $wallet->setModified(new \DateTime());
	}

	/**
	 * @param Wallet $wallet
	 * @throws IntegrityException
	 */
	public function delete(Wallet $wallet) {}

}
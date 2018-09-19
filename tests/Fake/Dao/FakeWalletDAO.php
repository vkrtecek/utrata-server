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
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemType;
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

    /**
     * FakeWalletDAO constructor.
     * @throws \App\Model\Exception\BadParameterException
     * @throws \App\Model\Exception\NotFoundException
     */
	public function __construct() {
		$this->wallet1 = new Wallet();
		$this->wallet1->setId(1);
		$this->wallet1->setName('wallet name 1');
		$this->wallet1->setCreated(new \DateTime());
		$this->wallet1->setMember((new FakeMemberService())->getMember('vojta'));
		$this->wallet2 = new Wallet();
		$this->wallet2->setId(2);
		$this->wallet2->setName('wallet name 2');
		$this->wallet2->setCreated(new \DateTime());
		$this->wallet2->setMember((new FakeMemberService())->getMember('jožka'));

		$this->cs1 = (new FakeCheckStateService())->getWalletCheckState($this->wallet1, ItemType::CARD);
		$this->cs2 = (new FakeCheckStateService())->getWalletCheckState($this->wallet1, ItemType::CASH);
	}

    /** @inheritdoc */
    public function findAll(): array {
		return [ $this->wallet1, $this->wallet2 ];
	}

    /** @inheritdoc */
    public function findOne(int $id): ?Wallet {
		return $this->wallet1;
	}

    /** @inheritdoc */
    public function findByColumn(string $key, string $val): array {
		return $this->findAll();
	}

    /** @inheritdoc */
    public function findOneByColumn(string $key, string $val): ?Wallet {
		return $this->wallet1;
	}

    /** @inheritdoc */
    public function getItems(Wallet $wallet): array {
		return [];
	}

    /** @inheritdoc */
    public function getCheckStates(Wallet $wallet): array {
		return [
			$this->cs1,
			$this->cs2
		];
	}

    /** @inheritdoc */
    public function create(Wallet $wallet): Wallet {
		return $wallet->setCreated(new \DateTime());
	}

    /** @inheritdoc */
    public function update(Wallet $wallet): Wallet {
		return $wallet->setModified(new \DateTime());
	}

	/** @inheritdoc */
	public function delete(Wallet $wallet) {}

}

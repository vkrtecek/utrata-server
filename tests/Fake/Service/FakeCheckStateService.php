<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 0:00
 */

namespace Tests\Fake\Service;


use App\Model\Entity\CheckState;
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemType;
use App\Model\Service\ICheckStateService;
use Tests\Exception\FirstDeleteForeignException;

class FakeCheckStateService implements ICheckStateService
{
	/** @var CheckState */
	protected $cs1;
	/** @var CheckState */
	protected $cs2;

    /**
     * FakeCheckStateService constructor.
     * @throws \App\Model\Exception\BadParameterException
     */
	public function __construct() {
		$wallet = new Wallet();
		$wallet->setId(1);

		$this->cs1 = new CheckState();
		$this->cs1->setId(1);
		$this->cs1->setType(ItemType::CARD);
		$this->cs1->setChecked(new \DateTime('2018-03-26 22:23:38'));
		$this->cs1->setValue(100);
		$this->cs1->setWallet($wallet);
		$this->cs2 = new CheckState();
		$this->cs2->setId(2);
		$this->cs2->setType(ItemType::CASH);
		$this->cs2->setChecked(new \DateTime('2018-03-26 22:23:38'));
		$this->cs2->setValue(30);
		$this->cs2->setWallet($wallet);
	}

    /** @inheritdoc */
    public function getWalletCheckStates(Wallet $wallet): array {
		return [
			$this->cs1,
			$this->cs2,
		];
	}

    /** @inheritdoc */
    public function getWalletCheckState(Wallet $wallet, string $type = ItemType::CARD): CheckState {
		if ($type == ItemType::CARD)
			return $this->cs1;
		else
			return $this->cs2;
	}

    /** @inheritdoc */
    public function getCheckState(int $id): CheckState {
		if ($id % 2)
			return $this->cs1;
		else
			return $this->cs2;
	}

    /** @inheritdoc */
    public function createCheckState(Wallet $wallet, string $type = ItemType::CARD): CheckState {
		if ($type == ItemType::CARD)
			return $this->cs1;
		else
			return $this->cs2;
	}

    /** @inheritdoc */
    public function updateCheckState(Wallet $wallet, string $type, float $value): CheckState {
		if ($type == ItemType::CARD)
			$c = $this->cs1;
		else
			$c = $this->cs2;
		$c->setValue($value);
		$c->setChecked(new \DateTime());
		return $c;
	}

    /**
     * @throws FirstDeleteForeignException
     * @inheritdoc
     */
    public function deleteCheckState(int $id) {
		throw new FirstDeleteForeignException();
	}

    /** @inheritdoc */
    public function format(CheckState $checkState): array {
		return [];
	}

	/** @inheritdoc */
	public function formatEntities(array $checkStates): array {
		return [];
	}
}

<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 3. 12. 2017
 * Time: 21:43
 */

namespace App\Model\Dao;


use App\Model\Entity\CheckState;
use App\Model\Entity\Item;
use App\Model\Entity\Wallet;

class WalletDAO extends AbstractDAO implements IWalletDAO
{
    /** @inheritdoc */
    public function findAll(): array {
		return $this->convertToArray(Wallet::all());
	}

    /** @inheritdoc */
    public function findOne(int $id): ?Wallet {
		return Wallet::find($id);
	}

    /** @inheritdoc */
    public function findByColumn(string $key, string $val): array {
		return $this->convertToArray(Wallet::where($key, $val)->get());
	}

    /** @inheritdoc */
    public function findOneByColumn(string $key, string $val): ?Wallet {
		return Wallet::where($key, $val)->first();
	}

    /** @inheritdoc */
    public function getItems(Wallet $wallet): array {
		return $this->convertToArray(Item::where('WalletID', $wallet->getId())->get());
	}

    /** @inheritdoc */
    public function getCheckStates(Wallet $wallet): array {
        return $this->convertToArray(CheckState::where('WalletID', $wallet->getId())->get());
	}

    /** @inheritdoc */
    public function create(Wallet $wallet): Wallet {
		$wallet->setCreated(new \DateTime());
		$wallet->save();
		return $wallet;
	}

    /** @inheritdoc */
    public function update(Wallet $wallet): Wallet {
		$wallet->setModified(new \DateTime());
		$wallet->save();
		return $wallet;
	}

	/** @inheritdoc */
	public function delete(Wallet $wallet) {
        $wallet->delete();
	}
}

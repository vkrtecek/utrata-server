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
use App\Model\Enum\ItemType;
use App\Model\Exception\IntegrityException;
use Illuminate\Database\QueryException;

class WalletDAO implements IWalletDAO
{
	/**
	 * @return Wallet[]|NULL
	 */
	public function findAll() {
		return Wallet::all();
	}

	/**
	 * @param int $id
	 * @return Wallet|NULL
	 */
	public function findOne($id) {
		return Wallet::find($id);
	}

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Wallet[]
	 */
	public function findByColumn($key, $val) {
		return Wallet::where($key, $val)->get();
	}

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Wallet
	 */
	public function findOneByColumn($key, $val) {
		return Wallet::where($key, $val)->first();
	}

	/**
	 * @param Wallet $wallet
	 * @return Item[]
	 */
	public function getItems(Wallet $wallet) {
		return Item::where('WalletID', $wallet->getId())->get();
	}

	/**
	 * @param Wallet $wallet
	 * @return CheckState[]
	 */
	public function getCheckStates(Wallet $wallet) {
		$ret = [];
		$ret[] = CheckState::where('WalletID', $wallet->getId())
			->where('type', ItemType::CARD)
			->first();
		$ret[] = CheckState::where('WalletID', $wallet->getId())
			->where('type', ItemType::CASH)
			->first();
		return $ret;
	}

	/**
	 * @param Wallet $wallet
	 * @return Wallet
	 */
	public function create(Wallet $wallet) {
		$wallet->setCreated(new \DateTime());
		$wallet->save();
		return $wallet;
	}

	/**
	 * @param Wallet $wallet
	 * @return Wallet
	 */
	public function update(Wallet $wallet) {
		$wallet->setModified(new \DateTime());
		$wallet->save();
		return $wallet;
	}

	/**
	 * @param Wallet $wallet
	 * @throws IntegrityException
	 */
	public function delete(Wallet $wallet) {
		try {
			$wallet->delete();
		} catch (QueryException $ex) {
			throw new IntegrityException('Integrity violation');
		}
	}
}
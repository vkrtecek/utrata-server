<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 3. 12. 2017
 * Time: 21:41
 */

namespace App\Model\Dao;


use App\Model\Entity\CheckState;
use App\Model\Entity\Item;
use App\Model\Entity\Wallet;
use App\Model\Exception\IntegrityException;

interface IWalletDAO
{
	/**
	 * @return Wallet[]|NULL
	 */
	public function findAll();

	/**
	 * @param int $id
	 * @return Wallet|NULL
	 */
	public function findOne($id);

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Wallet[]
	 */
	public function findByColumn($key, $val);

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Wallet
	 */
	public function findOneByColumn($key, $val);

	/**
	 * @param Wallet $wallet
	 * @return Item[]
	 */
	public function getItems(Wallet $wallet);

	/**
	 * @param Wallet $wallet
	 * @return CheckState[]
	 */
	public function getCheckStates(Wallet $wallet);

	/**
	 * @param Wallet $wallet
	 * @return Wallet
	 */
	public function create(Wallet $wallet);

	/**
	 * @param Wallet $wallet
	 * @return Wallet
	 */
	public function update(Wallet $wallet);

	/**
	 * @param Wallet $wallet
	 * @throws IntegrityException
	 */
	public function delete(Wallet $wallet);
}
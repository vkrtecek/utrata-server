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
	 * @return Wallet[]
	 */
	public function findAll(): array;

	/**
	 * @param int $id
	 * @return Wallet|NULL
	 */
	public function findOne(int $id): ?Wallet;

	/**
	 * @param string $key
	 * @param string $val
	 * @return Wallet[]
	 */
	public function findByColumn(string $key, string $val): array;

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Wallet
	 */
	public function findOneByColumn(string $key, string $val): ?Wallet;

	/**
	 * @param Wallet $wallet
	 * @return Item[]
	 */
	public function getItems(Wallet $wallet): array;

	/**
	 * @param Wallet $wallet
	 * @return CheckState[]
	 */
	public function getCheckStates(Wallet $wallet): array;

	/**
	 * @param Wallet $wallet
	 * @return Wallet
	 */
	public function create(Wallet $wallet): Wallet;

	/**
	 * @param Wallet $wallet
	 * @return Wallet
	 */
	public function update(Wallet $wallet): Wallet;

	/**
	 * @param Wallet $wallet
	 * @throws IntegrityException
	 */
	public function delete(Wallet $wallet);
}

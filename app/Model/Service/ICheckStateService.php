<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:22
 */

namespace App\Model\Service;


use App\Model\Entity\CheckState;
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemType;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;

interface ICheckStateService
{
	/**
	 * @param Wallet $wallet
	 * @return CheckState[]
	 * @throws NotFoundException
	 */
	public function getWalletCheckStates(Wallet $wallet): array;

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return CheckState
	 * @throws NotFoundException
	 */
	public function getWalletCheckState(Wallet $wallet, string $type = ItemType::CARD): CheckState;

	/**
	 * @param int $id
	 * @return CheckState
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getCheckState(int $id): CheckState;

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return CheckState
	 * @throws BadParameterException
	 */
	public function createCheckState(Wallet $wallet, string $type = ItemType::CARD): CheckState;

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @param double $value
	 * @return CheckState
	 * @throws NotFoundException
	 */
	public function updateCheckState(Wallet $wallet, string $type, float $value): CheckState;

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteCheckState(int $id);

	/**
	 * @param CheckState $checkState
	 * @return array
	 */
	public function format(CheckState $checkState): array;

	/**
	 * @param CheckState[] $checkStates
	 * @return array
	 */
	public function formatEntities(array $checkStates): array;
}

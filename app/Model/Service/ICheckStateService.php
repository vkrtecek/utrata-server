<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 17:22
 */

namespace App\Model\Service;


use App\Model\Entity\CheckState;
use App\Model\Entity\Member;
use App\Model\Entity\Wallet;
use App\Model\Enum\ItemType;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface ICheckStateService
{
	/**
	 * @param Wallet $wallet
	 * @return CheckState[]
	 * @throws NotFoundException
	 */
	public function getWalletCheckStates(Wallet $wallet);

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return CheckState
	 * @throws NotFoundException
	 */
	public function getWalletCheckState(Wallet $wallet, $type = ItemType::CARD);

	/**
	 * @param int $id
	 * @return CheckState
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getCheckState($id);

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @return CheckState
	 * @throws BadRequestHttpException
	 */
	public function createCheckState(Wallet $wallet, $type = ItemType::CARD);

	/**
	 * @param Wallet $wallet
	 * @param string $type
	 * @param double $value
	 * @return CheckState
	 * @throws NotFoundException
	 */
	public function updateCheckState(Wallet $wallet, $type, $value);

	/**
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteCheckState($id);

	/**
	 * @param CheckState $checkState
	 * @return array
	 */
	public function format(CheckState $checkState);

	/**
	 * @param CheckState[] $checkStates
	 * @return array
	 */
	public function formatEntities($checkStates);
}
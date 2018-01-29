<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 15:26
 */

namespace App\Model\Service;


use App\Model\Entity\Member;
use App\Model\Entity\Wallet;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface IWalletService
{
	/**
	 * @param string $login
	 * @return Wallet[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getWallets($login);

	/**
	 * @param int $id
	 * @param Member $member
	 * @return Wallet
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getWallet($id, Member $member);

	/**
	 * @param $data
	 * @return Wallet
	 * @throws AlreadyExistException
	 * @throws BadRequestHttpException
	 * @throws NotFoundException
	 */
	public function createWallet($data);

	/**
	 * @param int $id
	 * @param $data
	 * @return Wallet
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateWallet($id, $data);

	/**
	 * @param int $id
	 * @param Member $member
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 * @throws IntegrityException
	 */
	public function deleteWallet($id, Member $member);

	/**
	 * @param Wallet $wallet
	 * @return array
	 */
	public function format(Wallet $wallet);

	/**
	 * @param Wallet[] $wallets
	 * @return array
	 */
	public function formatEntities($wallets);
}
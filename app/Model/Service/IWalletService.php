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
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\BadRequestException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\UnderEntityNotFoundException;

interface IWalletService
{
	/**
     * get all user's wallets
	 * @param string $login
	 * @return Wallet[]
	 * @throws NotFoundException
	 */
	public function getWallets(string $login): array;

	/**
	 * @param int $id
	 * @param Member $member
	 * @return Wallet
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getWallet(int $id, Member $member): Wallet;

    /**
     * @param Member $member
     * @return Wallet[]
     */
	public function getByMember(Member $member): array;

	/**
	 * @param Member $member
	 * @param string $name
	 * @return Wallet
	 * @throws BadParameterException
	 */
	public function createWallet(Member $member, string $name): Wallet;

	/**
	 * @param Member $member
	 * @param int $id
	 * @param string $name
	 * @return Wallet
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestException
	 * @throws AuthenticationException
	 */
	public function updateWallet(Member $member, int $id, string $name): Wallet;

	/**
	 * @param int $id
	 * @param Member $member
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 * @throws IntegrityException
	 */
	public function deleteWallet(int $id, Member $member);

	/**
	 * @param Wallet $wallet
	 * @return array
	 * @throws UnderEntityNotFoundException
	 */
	public function format(Wallet $wallet): array;

	/**
	 * @param Wallet[] $wallets
	 * @return array
	 * @throws UnderEntityNotFoundException
	 */
	public function formatEntities(array $wallets): array;


	/**
	 * @param Member $member
	 * @param int $walletId
	 * @param string $type
	 * @param double $value
	 * @return array
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function updateCheckState(Member $member, int $walletId, string $type, float$value): array;
}

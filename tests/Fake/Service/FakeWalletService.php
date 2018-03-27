<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 8:34
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Member;
use App\Model\Entity\Wallet;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Exception\UnderEntityNotFoundException;
use App\Model\Service\IWalletService;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tests\Fake\Dao\FakeWalletDAO;

class FakeWalletService implements IWalletService
{
	/**
	 * @param string $login
	 * @return Wallet[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 */
	public function getWallets($login) {
		return (new FakeWalletDAO())->findAll();
	}

	/**
	 * @param int $id
	 * @param Member $member
	 * @return Wallet
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getWallet($id, Member $member) {
		return (new FakeWalletDAO())->findOne(1);
	}

	/**
	 * @param Member $member
	 * @param string $name
	 * @return Wallet
	 */
	public function createWallet(Member $member, $name) {}

	/**
	 * @param Member $member
	 * @param int $id
	 * @param string $name
	 * @return Wallet
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 * @throws AuthenticationException
	 */
	public function updateWallet(Member $member, $id, $name) {}

	/**
	 * @param int $id
	 * @param Member $member
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 * @throws IntegrityException
	 */
	public function deleteWallet($id, Member $member) {}

	/**
	 * @param Wallet $wallet
	 * @return array
	 * @throws UnderEntityNotFoundException
	 */
	public function format(Wallet $wallet) {}

	/**
	 * @param Wallet[] $wallets
	 * @return array
	 * @throws UnderEntityNotFoundException
	 */
	public function formatEntities($wallets) {}


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
	public function updateCheckState(Member $member, $walletId, $type, $value) {}
}
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
use App\Model\Exception\BadParameterException;
use App\Model\Exception\NotFoundException;
use App\Model\Service\IWalletService;
use Tests\Fake\Dao\FakeWalletDAO;

class FakeWalletService implements IWalletService
{
    /**
     * @inheritdoc
     * @throws BadParameterException
     */
    public function getWallets(string $login): array {
		return (new FakeWalletDAO())->findAll();
	}

    /** @inheritdoc */
    public function getWallet(int $id, Member $member): Wallet {
		return (new FakeWalletDAO())->findOne(1);
	}

	/** @inheritdoc */
    public function getByMember(Member $member): array {
        return [];
    }

    /**
     * @throws NotFoundException
     * @inheritdoc
     */
    public function createWallet(Member $member, string $name): Wallet {
        return (new FakeWalletDAO())->findOne(1);
    }

    /** @inheritdoc */
    public function updateWallet(Member $member, int $id, string $name): Wallet {
        return (new FakeWalletDAO())->findOne(1);
    }

    /** @inheritdoc */
    public function deleteWallet(int $id, Member $member) {}

    /** @inheritdoc */
    public function format(Wallet $wallet): array {
        return [];
    }

    /** @inheritdoc */
    public function formatEntities(array $wallets): array {
        return [];
    }


    /** @inheritdoc */
    public function updateCheckState(Member $member, int $walletId, string $type, float $value): array {
        return [];
    }
}

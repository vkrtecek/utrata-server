<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 26. 3. 2018
 * Time: 8:37
 */

namespace Tests\Fake\Service;


use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Filter\ItemFilter;
use App\Model\Service\IItemService;
use Tests\Fake\Dao\FakeItemDAO;

class FakeItemService implements IItemService
{
    /** @inheritdoc */
    public function getWalletItems(int $walletId, Member $member, ?ItemFilter $filter = NULL): array {
		return (new FakeItemDAO())->findAll();
	}

    /** @inheritdoc */
    public function getMonthStatistics(Member $member, int $walletId, string $purposes = NULL): array {
        return [];
    }

    /**
     * @inheritdoc
     * @throws \App\Model\Exception\AuthenticationException
     */
    public function getItem(int $id): Item {
		return (new FakeItemDAO())->findOne($id);
	}

	/** @inheritdoc */
    public function getMembersItems(Member $member): array {
        return [];
    }

	/** @inheritdoc */
    public function priceByFilter(Member $member, ItemFilter $filter): float {
        return 0.0;
    }

    /** @inheritdoc */
    public function createItem(Member $member, array $data): Item {
        return (new FakeItemDAO())->findOne(1);
    }

    /** @inheritdoc */
    public function checkItem(Member $member, int $id): int {
        return 0;
    }

    /** @inheritdoc */
    public function checkAll(int $walletId, Member $member, ItemFilter $filter = NULL): int {
        return 0;
    }


    /** @inheritdoc */
    public function updateItem(Member $member, int $id, array $data): Item {
        return (new FakeItemDAO())->findOne(1);
    }

    /** @inheritdoc */
    public function deleteItem(Member $member, int $id): int {
        return 0;
    }

    /** @inheritdoc */
    public function format(Item $item, Member $member): array {
        return [];
    }

    /** @inheritdoc */
    public function formatEntities(array $items, Member $member): array {
        return [];
    }

    /** @inheritdoc */
    public function count(ItemFilter $filter): int {
        return 0;
    }
}

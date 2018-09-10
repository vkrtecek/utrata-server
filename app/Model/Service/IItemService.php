<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 16:09
 */

namespace App\Model\Service;

use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Exception\AlreadyExistException;
use App\Model\Exception\AuthenticationException;
use App\Model\Exception\BadParameterException;
use App\Model\Exception\IntegrityException;
use App\Model\Exception\NotFoundException;
use App\Model\Filter\ItemFilter;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

interface IItemService
{
	/**
	 * @param int $walletId
	 * @param Member $member
	 * @param ItemFilter $filter
	 * @return Item[]
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getWalletItems(int $walletId, Member $member, ?ItemFilter $filter = NULL): array;


	/**
	 * @param Member $member
	 * @param int $walletId
	 * @param string $purposes expected in form like "1,3,5,7"
	 * @return array
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function getMonthStatistics(Member $member, int $walletId, $purposes = NULL): array;

	/**
	 * @param int $id
	 * @return Item
	 * @throws BadParameterException
	 * @throws NotFoundException
	 */
	public function getItem(int $id): Item;

	/**
	 * @param Member $member
	 * @param $data
	 * @return Item
	 * @throws BadRequestHttpException
	 * @throws AlreadyExistException
	 * @throws NotFoundException
	 */
	public function createItem(Member $member, array $data): Item;

	/**
	 * @param Member $member
	 * @param int $id
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function checkItem(Member $member, int $id): int;

	/**
	 * @param int $walletId
	 * @param Member $member
     * @param ItemFilter $filter
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws AuthenticationException
	 */
	public function checkAll(int $walletId, Member $member, ItemFilter $filter): int;


	/**
	 * @param Member $member
	 * @param int $id
	 * @param $data
	 * @return Item
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws BadRequestHttpException
	 */
	public function updateItem(Member $member, int $id, array $data): Item;

	/**
	 * @param Member $member
	 * @param int $id id of item
	 * @return int
	 * @throws NotFoundException
	 * @throws BadParameterException
	 * @throws IntegrityException
	 */
	public function deleteItem(Member $member, int $id): int;

	/**
	 * @param Item $item
	 * @param Member $member
	 * @return array
	 */
	public function format(Item $item, Member $member): array;

	/**
	 * @param Item[] $items
	 * @param Member $member
	 * @return array
	 */
	public function formatEntities(array $items, Member $member): array;

    /**
     * @param ItemFilter $filter
     * @return int
     */
	public function count(ItemFilter $filter): int;
}

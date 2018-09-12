<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 6. 11. 2017
 * Time: 23:56
 */

namespace App\Model\Dao;


use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Exception\IntegrityException;
use App\Model\Filter\ItemFilter;

interface IItemDAO
{
    /**
     * @return Item[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Item|NULL
     */
    public function findOne(int $id): ?Item;

	/**
	 * @param string $key
	 * @param string $val
	 * @return Item[]
	 */
	public function findByColumn(string $key, string $val): array;

	/**
	 * @param ItemFilter $filters
	 * @return Item[]
	 */
	public function findByFilter(ItemFilter $filters): array;

	/**
	 * @param ItemFilter $filter
	 * @return Item[]
	 */
	public function findUsersItemsByNotes(ItemFilter $filter): array;

    /**
     * @param Member $member
     * @return Item[]|NULL
     */
    public function findUserItems(Member $member): array;

	/**
	 * @param Member $member
	 * @return Item|NULL
	 */
	public function findUserLastItem(Member $member): ?Item;

    /**
     * @param Item $item
     * @return Item
     */
    public function create(Item $item): Item;

    /**
     * @param Item $item
     * @return Item
     */
    public function update(Item $item): Item;

    /**
     * @param Item $item
     * @throws IntegrityException
     */
    public function delete(Item $item);

	/**
	 * @param Item $item
	 * @return Item|NULL
	 */
	public function checkExistence(Item $item): ?Item;

    /**
     * @param ItemFilter $filter
     * @return int
     */
	public function count(ItemFilter $filter): int;
}

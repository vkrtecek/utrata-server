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
     * @return Item[]|NULL
     */
    public function findAll();

    /**
     * @param int $id
     * @return Item|NULL
     */
    public function findOne($id);

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Item[]|NULL
	 */
	public function findByColumn($key, $val);

	/**
	 * @param ItemFilter $filters
	 * @return Item[]
	 */
	public function findByFilter(ItemFilter $filters);

	/**
	 * @param ItemFilter $filter
	 * @return Item[]
	 */
	public function findUsersItemsByNotes(ItemFilter $filter);

    /**
     * @param Member $member
     * @return Item[]|NULL
     */
    public function findUserItems(Member $member);

	/**
	 * @param Member $member
	 * @return Item
	 */
	public function findUserLastItem(Member $member);

    /**
     * @param Item $item
     * @return Item
     */
    public function create(Item $item);

    /**
     * @param Item $item
     * @return Item
     */
    public function update(Item $item);

    /**
     * @param Item $item
     * @throws IntegrityException
     */
    public function delete(Item $item);

	/**
	 * @param Item $item
	 * @return Item|NULL
	 */
	public function checkExistence(Item $item);
}
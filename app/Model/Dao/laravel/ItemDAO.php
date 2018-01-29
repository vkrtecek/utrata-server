<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 7. 11. 2017
 * Time: 0:14
 */

namespace App\Model\Dao;


use App\Model\Entity\Item;
use App\Model\Entity\Member;
use App\Model\Exception\IntegrityException;
use App\Model\Filter\ItemFilter;

class ItemDAO implements IItemDAO
{
	/**
     * @return Item[]|NULL
     */
    public function findAll() {
    	return Item::all();
    }

    /**
     * @param int $id
     * @return Item|NULL
     */
    public function findOne($id) {
    	return Item::find($id);
    }

	/**
	 * @param string $key
	 * @param mixed $val
	 * @return Item[]|NULL
	 */
	public function findByColumn($key, $val) {
		return Item::where($key, $val)->get();
	}

	/**
	 * @param ItemFilter $filters
	 * @return Item[]
	 */
	public function findByFilter(ItemFilter $filters) {
		$items = Item::where('WalletID', $filters->getWalletId());
		if ($filters->getMonth() != "") $items->where('date', 'LIKE', '%-'.$filters->getMonth().'-%');
		if ($filters->getYear() != "") $items->where('date', 'LIKE', $filters->getYear().'-%');
		if (count($filters->getNotes())) {
			$items->where('PurposeID', $filters->getNotes());
		}
		if ($filters->getPattern() != "")
			$items->where('mainName', 'LIKE', '%' . $filters->getPattern() . '%' )
			->orWhere('description', 'LIKE', $filters->getPattern());
		$items->orderBy($filters->getOrderBy(), $filters->getOrderHow());

		return $items->get();
	}

    /**
     * @param Member $member
     * @return Item[]|NULL
     */
    public function findUserItems(Member $member) {
		return Item::where('MemberID', $member->getId())->get();
    }

    /**
     * @param Item $item
     * @return Item
     */
    public function create(Item $item) {
    	$item->setCreated(new \DateTime());
    	$item->save();
		return $item;
    }

    /**
     * @param Item $item
     * @return Item
     */
    public function update(Item $item) {
    	$item->setModified(new \DateTime());
		$item->save();
		return $item;
    }

    /**
     * @param Item $item
     * @throws IntegrityException
     */
    public function delete(Item $item) {
		try {
			$item->delete();
		} catch (\Exception $ex) {
			//FK key violation
			throw new IntegrityException($ex->getMessage(), 0, $ex);
		}
    }
}
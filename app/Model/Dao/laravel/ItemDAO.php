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
			$statement = '(PurposeID = ' . $filters->getNotes()[0];
			for ($i = 1; $i < count($filters->getNotes()); $i++)
				$statement .= ' OR PurposeID = ' . $filters->getNotes()[$i];
			$statement .= ')';
			$items->whereRaw($statement);
		}
		if ($filters->getPattern() != "") {
			$patterns = explode(ItemFilter::WORD_SEPARATOR, $filters->getPattern());
			foreach ($patterns as $pattern) {
				if ($pattern[0] == '!') {
					$pattern = substr($pattern, 1);
					$pattern = str_replace('\\ \\ ', '  ', $pattern);
					$pattern = str_replace('\\!', '!', $pattern);
					$items->whereRaw("( mainName NOT LIKE '%" . $pattern . "%' AND description NOT LIKE '%" . $pattern . "%' AND type != '" . $pattern . "' )");
				}
				else {
					$pattern = str_replace('\\ \\ ', '  ', $pattern);
					$pattern = str_replace('\\!', '!', $pattern);
					$items->whereRaw("( mainName LIKE '%" . $pattern . "%' OR description LIKE '%" . $pattern . "%' OR type = '" . $pattern . "' )");
				}
			}
		}
		if ($filters->isVyber() !== NULL) $items->where('vyber', $filters->isVyber());
		if ($filters->isActive() !== NULL) $items->where('active', $filters->isActive());
		$items->where('income', $filters->isIncome());
		$items->orderBy($filters->getOrderBy(), $filters->getOrderHow());

		if ($filters->getLimit()) $items->limit($filters->getLimit());

		return $items->get();
	}

	/**
	 * @param ItemFilter $filter
	 * @return Item[]
	 */
	public function findUsersItemsByNotes(ItemFilter $filter) {
		$items = Item::where('MemberID', $filter->getMember()->getId());
		$items->where('PurposeID', $filter->getNotes());
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
	 * @param Member $member
	 * @return Item
	 */
	public function findUserLastItem(Member $member) {
		return Item::where('MemberID', $member->getId())
			->orderBy('date', 'desc')->first();
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

	/**
	 * @param Item $item
	 * @return Item|NULL
	 */
	public function checkExistence(Item $item) {
		$item = Item::where('mainName', $item->getName())
			->where('description', $item->getDescription())
			->where('price', $item->getPrice())
			->where('course', $item->getCourse())
			->where('date', $item->getDate()->format('Y-m-d H:i:s'))
			->where('WalletID', $item->getWallet()->getId())
			->first();
		return !$item ? NULL : $item;
	}
}
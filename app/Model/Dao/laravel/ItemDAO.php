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
use Illuminate\Database\Eloquent\Builder;

class ItemDAO extends AbstractDAO implements IItemDAO
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
		$items = $this->getBuilderByFilter($filters);
		return $this->convertToArray($items->get());
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

    /** @inheritdoc */
    public function count(ItemFilter $filter): int {
        return $this->getBuilderByFilter($filter)->count();
    }

    /**
     * @param ItemFilter $filter
     * @return Builder
     */
    private function getBuilderByFilter(ItemFilter $filter): Builder {
        $items = Item::where('WalletID', $filter->getWalletId());
        if ($filter->getMonth() != "") $items->where('date', 'LIKE', '%-'.$filter->getMonth().'-%');
        if ($filter->getYear() != "") $items->where('date', 'LIKE', $filter->getYear().'-%');
        if (count($filter->getNotes())) {
            $statement = '(PurposeID = ' . $filter->getNotes()[0];
            for ($i = 1; $i < count($filter->getNotes()); $i++)
                $statement .= ' OR PurposeID = ' . $filter->getNotes()[$i];
            $statement .= ')';
            $items->whereRaw($statement);
        }
        if ($filter->getPattern() != "") {
            $patterns = explode(ItemFilter::WORD_SEPARATOR, $filter->getPattern());
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
        if ($filter->isVyber() !== NULL) $items->where('vyber', $filter->isVyber());
        if ($filter->isActive() !== NULL) $items->where('active', $filter->isActive());
        $items->where('income', $filter->isIncome());
        $items->orderBy($filter->getOrderBy(), $filter->getOrderHow());

        if ($filter->getLimit()) $items->limit($filter->getLimit());
        if ($filter->getPage()) $items->offset(($filter->getPage()-1) * $filter->getLimit());

        return $items;
    }
}

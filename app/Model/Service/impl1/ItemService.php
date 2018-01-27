<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 16:13
 */

namespace App\Model\Service;


use App\Model\Entity\Item;

class ItemService implements IItemService
{
	/**
	 * @param int $walletId
	 * @return Item[]
	 */
	function getWalletItems($walletId) {
		$items = Item::all();
		$ret = [];
		foreach ($items as $item) {
			if ($item->getAttributes()['WalletID'] == $walletId)
				$ret[] = $item;
		}
		return $ret;
	}
}
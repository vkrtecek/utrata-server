<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 16:09
 */

namespace App\Model\Service;


use App\Model\Entity\Item;

interface IItemService
{
	/**
	 * @param int $walletId
	 * @return Item[]
	 */
	function getWalletItems($walletId);
}
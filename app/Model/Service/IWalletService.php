<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 15:26
 */

namespace App\Model\Service;


interface IWalletService
{
	/**
	 * @return array
	 */
	public function getData();
}
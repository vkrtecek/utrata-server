<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 1. 2018
 * Time: 15:28
 */

namespace App\Model\Service;


use App\Model\Entity\Wallet;

class WalletService implements IWalletService
{
	public function getData()
	{
		{
			$wallets = Wallet::all();
			$body = [
				'wallets' => $wallets
			];
			return $body;
		}
	}
}
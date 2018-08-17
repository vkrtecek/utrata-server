<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 3. 2018
 * Time: 15:46
 */

namespace Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
	public function run() {
		$this->prepareData();
		DB::table('utrata_wallets')->insert($this->data);
	}

	private $data = [];

	private function prepareData() {
		$this->data = [
			[
				'WalletID' =>  1,
				'name' =>  'rodičů',
				'created' =>  '2018-03-27 14:35:26',
				'modified' =>  '2018-03-27 14:35:26',
				'MemberID' =>  1,
			],
			[
				'WalletID' =>  2,
				'name' =>  'moje',
				'created' =>  '2018-03-27 14:35:26',
				'modified' =>  '2018-03-27 14:35:26',
				'MemberID' =>  1,
			],
			[
				'WalletID' =>  3,
				'name' =>  'janina',
				'created' =>  '2018-03-27 14:35:26',
				'modified' =>  '2018-03-27 14:35:26',
				'MemberID' =>  2,
			],
			[
				'WalletID' =>  4,
				'name' =>  'facebooková',
				'created' =>  '2018-03-27 14:35:26',
				'modified' =>  '2018-03-27 14:35:26',
				'MemberID' =>  3,
			],
		];
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 3. 2018
 * Time: 15:51
 */

namespace Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CheckStateSeeder extends Seeder
{
	public function run() {
		$this->prepareData();
		DB::table('utrata_check_states')->insert($this->data);
	}
  
	private $data = [];

	private function prepareData() {
		$this->data = [
			[
				'CheckStateID' => 1,
				'type' => 'karta',
				'checked' => '2018-03-27 14:15:22',
				'value' => 100.30,
				'WalletID' => 1,
			],
			[
				'CheckStateID' => 2,
				'type' => 'hotovost',
				'checked' => '2018-03-27 14:15:22',
				'value' => 100.30,
				'WalletID' => 1,
			],
			[
				'CheckStateID' => 3,
				'type' => 'karta',
				'checked' => '2018-03-27 14:15:22',
				'value' => 100.30,
				'WalletID' => 2,
			],
			[
				'CheckStateID' => 4,
				'type' => 'hotovost',
				'checked' => '2018-03-27 14:15:22',
				'value' => 100.30,
				'WalletID' => 2,
			],
			[
				'CheckStateID' => 5,
				'type' => 'karta',
				'checked' => '2018-03-27 14:15:22',
				'value' => 100.30,
				'WalletID' => 3,
			],
			[
				'CheckStateID' => 6,
				'type' => 'hotovost',
				'checked' => '2018-03-27 14:15:22',
				'value' => 100.30,
				'WalletID' => 3,
			],
			[
				'CheckStateID' => 7,
				'type' => 'karta',
				'checked' => '2018-03-27 14:15:22',
				'value' => 100.30,
				'WalletID' => 4,
			],
			[
				'CheckStateID' => 8,
				'type' => 'hotovost',
				'checked' => '2018-03-27 14:15:22',
				'value' => 100.30,
				'WalletID' => 4,
			],
		];
	}
}
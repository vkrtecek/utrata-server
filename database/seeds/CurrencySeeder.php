<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 25. 3. 2018
 * Time: 0:08
 */

namespace Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
	public function run() {
		$this->prepareData();
		DB::table('utrata_currencies')->insert($this->data);
	}
  
	private $data = [];

	private function prepareData() {
		$this->data = [
			[
				'CurrencyID' => 1,
				'code' => 'CZK',
				'value' => 'Kč',
				'name' => 'Česká koruna',
			],
			[
				'CurrencyID' => 2,
				'code' => 'EUR',
				'value' => '€',
				'name' => 'Euro',
			],
			[
				'CurrencyID' => 3,
				'code' => 'USD',
				'value' => '$',
				'name' => 'Dollar',
			],
		];
	}
}
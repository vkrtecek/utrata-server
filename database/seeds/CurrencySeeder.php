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
		DB::table('utrata_currencies')->insert([
			'CurrencyID' => 1,
			'code' => 'CZK',
			'value' => 'Kč',
			'name' => 'Česká koruna',
		]);
		DB::table('utrata_currencies')->insert([
			'CurrencyID' => 1,
			'code' => 'EUR',
			'value' => '€',
			'name' => 'Euro',
		]);
		DB::table('utrata_currencies')->insert([
			'CurrencyID' => 1,
			'code' => 'USD',
			'value' => '$',
			'name' => 'Dollar',
		]);
	}
}
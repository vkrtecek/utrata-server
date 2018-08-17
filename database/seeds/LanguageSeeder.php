<?php

/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 24. 3. 2018
 * Time: 23:55
 */
namespace Seeds;

use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
	public function run() {
		$this->prepareData();
		DB::table('utrata_languages')->insert($this->data);
	}
  
	private $data = [];

	private function prepareData() {
		$this->data = [
			[
				'LanguageCode' => 'CZK',
				'name' => 'Česky',
				'locale' => 'cs',
			],
			[
				'LanguageCode' => 'ENG',
				'name' => 'English',
				'locale' => 'en',
			],
			[
				'LanguageCode' => 'SVK',
				'name' => 'Slovensky',
				'locale' => 'sk',
			],
		];
	}
}
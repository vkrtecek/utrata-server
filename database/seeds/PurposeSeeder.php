<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 24. 3. 2018
 * Time: 23:58
 */

namespace Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurposeSeeder extends Seeder
{
	public function run() {
		$this->prepareData();
		DB::table('utrata_purposes')->insert($this->data);
	}
  
	private $data = [];

	private function prepareData() {
		$this->data = [
			[
				'PurposeID' => 1,
				'code' => 'jidlo',
				'value' => 'Jídlo',
				'base' => 1,
				'LanguageCode' => 'CZK',
				'CreatorID' => NULL,
			],
			[
				'PurposeID' => 2,
				'code' => 'transport',
				'value' => 'Transport',
				'base' => 1,
				'LanguageCode' => 'CZK',
				'CreatorID' => NULL,
			],
			[
				'PurposeID' => 3,
				'code' => 'kosmetika',
				'value' => 'Kosmetika',
				'base' => 0,
				'LanguageCode' => 'CZK',
				'CreatorID' => NULL,
			],
			[
				'PurposeID' => 4,
				'code' => 'leky',
				'value' => 'Léky',
				'base' => 0,
				'LanguageCode' => 'CZK',
				'CreatorID' => NULL,
			],
			[
				'PurposeID' => 5,
				'code' => 'ostatni',
				'value' => 'Ostatní',
				'base' => 1,
				'LanguageCode' => 'CZK',
				'CreatorID' => NULL,
			],
			[
				'PurposeID' => 6,
				'code' => 'food',
				'value' => 'Food',
				'base' => 1,
				'LanguageCode' => 'ENG',
				'CreatorID' => NULL,
			],
			[
				'PurposeID' => 7,
				'code' => 'other',
				'value' => 'Other',
				'base' => 1,
				'LanguageCode' => 'ENG',
				'CreatorID' => NULL,
			],
		];
	}
}
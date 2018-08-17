<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 25. 3. 2018
 * Time: 0:11
 */

namespace Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberPurposeSeeder extends Seeder
{
	public function run() {
		$this->prepareData();
		DB::table('utrata_memberpurposes')->insert($this->data);
	}
  
	private $data = [];

	private function prepareData() {
		$this->data = [
			[
				'PurposeID' => 1,
				'MemberID' => 1,
			],
			[
				'PurposeID' => 2,
				'MemberID' => 1,
			],
			[
				'PurposeID' => 5,
				'MemberID' => 1,
			],
			[
				'PurposeID' => 1,
				'MemberID' => 2,
			],
			[
				'PurposeID' => 2,
				'MemberID' => 2,
			],
			[
				'PurposeID' => 3,
				'MemberID' => 2,
			],
			[
				'PurposeID' => 4,
				'MemberID' => 2,
			],
			[
				'PurposeID' => 5,
				'MemberID' => 2,
			],
			[
				'PurposeID' => 6,
				'MemberID' => 3,
			],
			[
				'PurposeID' => 7,
				'MemberID' => 3,
			],
		];
	}
}
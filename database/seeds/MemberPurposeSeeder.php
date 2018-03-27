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
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 1,
			'MemberID' => 1,
		]);
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 2,
			'MemberID' => 1,
		]);
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 5,
			'MemberID' => 1,
		]);
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 1,
			'MemberID' => 2,
		]);
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 2,
			'MemberID' => 2,
		]);
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 3,
			'MemberID' => 2,
		]);
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 4,
			'MemberID' => 2,
		]);
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 5,
			'MemberID' => 2,
		]);
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 6,
			'MemberID' => 3,
		]);
		DB::table('utrata_memberpurposes')->insert([
			'PurposeID' => 7,
			'MemberID' => 3,
		]);
	}
}
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
		DB::table('utrata_languages')->insert([
			'LanguageCode' => 'CZK',
			'name' => 'Česky',
			'locale' => 'cs',
		]);
		DB::table('utrata_languages')->insert([
			'LanguageCode' => 'ENG',
			'name' => 'English',
			'locale' => 'en',
		]);
		DB::table('utrata_languages')->insert([
			'LanguageCode' => 'SVK',
			'name' => 'Slovensky',
			'locale' => 'sk',
		]);
	}
}
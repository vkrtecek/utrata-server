<?php

/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 24. 3. 2018
 * Time: 23:54
 */
namespace Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
	public function run() {
		DB::table('utrata_members')->insert([
			'MemberID' => 1,
			'firstName' => 'Štěpán',
			'lastName' => 'Krteček',
			'login' => 'vojta',
			'passwordHash' => '$2y$10$Mk3Ji0jttwhKABt0ywm4H.LmkEFsB7YCn2R3RqMvwbQQl1D3eXx7i',
			'sendMonthly' => 0,
			'sendByOne' => 0,
			'motherMail' => 'some@example.com',
			'myMail' => 'some@example.com',
			'admin' => 0,
			'logged' => 0,
			'token' => '',
			'expiration' => NULL,
			'created' => '2018-03-24 19:54:00',
			'facebook' => 0,
			'access' => NULL,
			'LanguageCode' => 'CZK',
			'CurrencyID' => 1,
		]);
	}
}
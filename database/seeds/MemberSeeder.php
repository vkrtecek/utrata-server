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
		$this->prepareData();
		DB::table('utrata_members')->insert($this->data);
	}
  
	private $data = [];

	private function prepareData() {
		$this->data = [
			[
				'MemberID' => 1,
				'firstName' => 'Štěpán',
				'lastName' => 'Krteček',
				'login' => 'vojta',
				'password' => '$2y$10$Mk3Ji0jttwhKABt0ywm4H.LmkEFsB7YCn2R3RqMvwbQQl1D3eXx7i',
				'sendMonthly' => 1,
				'sendByOne' => 0,
				'myMail' => 'some@example.com',
				'admin' => 0,
				'logged' => 1,
				'remember_token' => 'some token',
				'expiration' => ((new \DateTime())->format('Y') + 1) . '-03-24 19:54:10',
				'created' => '2015-09-25 19:52:48',
				'facebook' => 0,
				'access' => '2018-03-27 19:54:10',
				'LanguageCode' => 'CZK',
				'CurrencyID' => 1,
			],
			[
				'MemberID' => 2,
				'firstName' => 'Jana',
				'lastName' => 'Harníková',
				'login' => 'jana',
				'password' => '$2y$12$TLHfaHdPgYNepUOB6A1Bi.XPh8EunvuzxI0.Cvl8BSGgyNdxdqjua', //heslo
				'sendMonthly' => 1,
				'sendByOne' => 0,
				'myMail' => 'some@example.com',
				'admin' => 0,
				'logged' => 0,
				'remember_token' => '',
				'expiration' => NULL,
				'created' => '2015-09-25 19:52:48',
				'facebook' => 0,
				'access' => '2018-03-27 19:54:10',
				'LanguageCode' => 'CZK',
				'CurrencyID' => 1,
			],
			[
				'MemberID' => 3,
				'firstName' => 'Štěpán',
				'lastName' => 'Krteček',
				'login' => '10208700545829696',
				'password' => '$2y$12$TLHfaHdPgYNepUOB6A1Bi.XPh8EunvuzxI0.Cvl8BSGgyNdxdqjua', //heslo
				'sendMonthly' => 0,
				'sendByOne' => 0,
				'myMail' => 'some@example.com',
				'admin' => 0,
				'logged' => 3,
				'remember_token' => 'some token 2',
				'expiration' => NULL,
				'created' => '2015-09-25 19:52:48',
				'facebook' => 1,
				'access' => '2018-03-27 19:54:10',
				'LanguageCode' => 'ENG',
				'CurrencyID' => 2,
			],
		];
	}
}

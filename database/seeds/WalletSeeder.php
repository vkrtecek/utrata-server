<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 27. 3. 2018
 * Time: 15:46
 */

namespace Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WalletSeeder extends Seeder
{
	public function run() {
		DB::table('utrata_wallets')->insert([
			'WalletID' =>  1,
			'name' =>  'rodičů',
			'created' =>  '2018-03-27 14:35:26',
			'modified' =>  '2018-03-27 14:35:26',
			'MemberID' =>  1,
		]);
		DB::table('utrata_wallets')->insert([
			'WalletID' =>  2,
			'name' =>  'moje',
			'created' =>  '2018-03-27 14:35:26',
			'modified' =>  '2018-03-27 14:35:26',
			'MemberID' =>  1,
		]);
		DB::table('utrata_wallets')->insert([
			'WalletID' =>  3,
			'name' =>  'janina',
			'created' =>  '2018-03-27 14:35:26',
			'modified' =>  '2018-03-27 14:35:26',
			'MemberID' =>  2,
		]);
		DB::table('utrata_wallets')->insert([
			'WalletID' =>  4,
			'name' =>  'facebooková',
			'created' =>  '2018-03-27 14:35:26',
			'modified' =>  '2018-03-27 14:35:26',
			'MemberID' =>  3,
		]);
	}
}
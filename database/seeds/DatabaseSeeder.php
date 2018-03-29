<?php

use Illuminate\Database\Seeder;
use Seeds\LanguageSeeder;
use Seeds\TranslationSeeder;
use Seeds\CurrencySeeder;
use Seeds\MemberSeeder;
use Seeds\PurposeSeeder;
use Seeds\MemberPurposeSeeder;
use Seeds\CheckStateSeeder;
use Seeds\WalletSeeder;
use Seeds\ItemSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$this->call(LanguageSeeder::class);
		$this->call(TranslationSeeder::class);
		$this->call(CurrencySeeder::class);
		$this->call(MemberSeeder::class);
		$this->call(WalletSeeder::class);
		$this->call(PurposeSeeder::class);
		$this->call(MemberPurposeSeeder::class);
		$this->call(ItemSeeder::class);
		$this->call(CheckStateSeeder::class);
    }
}

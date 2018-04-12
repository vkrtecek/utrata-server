<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('utrata_languages', function(Blueprint $table) { //OK
			$table->string('LanguageCode')->primary();
			$table->string('name');
		});
		Schema::create('utrata_translations', function(Blueprint $table) {
			$table->string('TranslationCode');
			$table->string('value');
			// PRIMARY
			$table->string('LanguageCode');
			$table->foreign('LanguageCode')->references('LanguageCode')->on('utrata_languages');
			$table->primary(['TranslationCode', 'LanguageCode']);
		});
		Schema::create('utrata_currencies', function(Blueprint $table) {
			$table->integer('CurrencyID')->autoIncrement();
			$table->string('code');
			$table->string('value');
			$table->string('name');
		});
		Schema::create('utrata_members', function(Blueprint $table) {
			$table->bigInteger('MemberID')->autoIncrement();
			$table->string('firstName')->nullable();
			$table->string('lastName')->nullable();
			$table->string('login')->unique();
			$table->string('passwordHash');
			$table->boolean('sendMonthly')->default(true);
			$table->boolean('sendByOne')->default(false);
			$table->string('myMail');
			$table->boolean('admin')->default(false);
			$table->integer('logged')->default(0);
			$table->string('token')->nullable();
			$table->dateTime('expiration')->nullable();
			$table->dateTime('created')->default('2015-09-01 00:00:00');
			$table->boolean('facebook')->default(false);
			$table->dateTime('access')->nullable();

			$table->string('LanguageCode');
			$table->foreign('LanguageCode')->references('LanguageCode')->on('utrata_languages');

			$table->integer('CurrencyID');
			$table->foreign('CurrencyID')->references('CurrencyID')->on('utrata_currencies');
		});
		Schema::create('utrata_wallets', function(Blueprint $table) {
			$table->integer('WalletID')->autoIncrement();
			$table->string('name');
			$table->dateTime('created');
			$table->dateTime('modified')->nullable();

			$table->bigInteger('MemberID');
			$table->foreign('MemberID')->references('MemberID')->on('utrata_members');
		});
		Schema::create('utrata_purposes', function(Blueprint $table) {
			$table->integer('PurposeID')->autoIncrement();
			$table->string('code');
			$table->string('value');
			$table->boolean('base')->default(false);

			$table->string('LanguageCode');
			$table->foreign('LanguageCode')->references('LanguageCode')->on('utrata_languages');

			$table->bigInteger('CreatorID')->nullable();
			$table->foreign('CreatorID')->references('MemberID')->on('utrata_members');
		});
		Schema::create('utrata_memberpurposes', function(Blueprint $table) {
			$table->integer('MemberPurposeID')->autoIncrement();

			$table->integer('PurposeID');
			$table->foreign('PurposeID')->references('PurposeID')->on('utrata_purposes');

			$table->bigInteger('MemberID');
			$table->foreign('MemberID')->references('MemberID')->on('utrata_members');
		});
		Schema::create('utrata_items', function(Blueprint $table) {
			$table->bigInteger('ItemID')->autoIncrement();
			$table->string('mainName');
			$table->string('description')->nullable();
			$table->double('price');
			$table->double('course')->default(1);
			$table->dateTime('date');
			$table->dateTime('created');
			$table->dateTime('modified')->nullable();
			$table->string('type')->default('karta');
			$table->boolean('active')->default(true);
			$table->boolean('income')->default(false);
			$table->boolean('vyber')->default(false);
			$table->boolean('odepsat')->default(false);

			$table->integer('PurposeID')->nullable();
			$table->foreign('PurposeID')->references('PurposeID')->on('utrata_purposes');

			$table->integer('CurrencyID');
			$table->foreign('CurrencyID')->references('CurrencyID')->on('utrata_currencies');

			$table->integer('WalletID');
			$table->foreign('WalletID')->references('WalletID')->on('utrata_wallets');

			$table->bigInteger('MemberID');
			$table->foreign('MemberID')->references('MemberID')->on('utrata_members');
		});
		Schema::create('utrata_check_states', function(Blueprint $table) {
			$table->integer('CheckStateID')->autoIncrement();
			$table->string('type')->default('karta');
			$table->dateTime('checked');
			$table->double('value');

			$table->integer('WalletID');
			$table->foreign('WalletID')->references('WalletID')->on('utrata_wallets');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::dropIfExists('utrata_check_states');
		Schema::dropIfExists('utrata_items');
		Schema::dropIfExists('utrata_memberPurposes');
		Schema::dropIfExists('utrata_purposes');
		Schema::dropIfExists('utrata_wallets');
		Schema::dropIfExists('utrata_members');
		Schema::dropIfExists('utrata_currencies');
		Schema::dropIfExists('utrata_translations');
		Schema::dropIfExists('utrata_languages');
    }
}

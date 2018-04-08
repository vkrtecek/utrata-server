<?php
/**
 * Created by PhpStorm.
 * User: vkrte_000
 * Date: 25. 3. 2018
 * Time: 0:14
 */

namespace Seeds;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TranslationSeeder extends Seeder
{
	public function run() {
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Add',
			'value' => 'Jiná měna',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Course.Empty',
			'value' => 'Prázdný kurz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Course.Empty',
			'value' => 'Empty course',
			'LanguageCode' => 'ENG',
		]);
		/*
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Date.Empty',
			'value' => 'Nevyplněný datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Date.Empty',
			'value' => 'Empty date',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Name.Empty',
			'value' => 'Prázdný název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Name.Empty',
			'value' => 'Empty name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Price.BadFormat',
			'value' => 'Cena ve špatném formátu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Price.BadFormat',
			'value' => 'Price in bad format',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Price.Empty',
			'value' => 'Prázdná cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Error.Price.Empty',
			'value' => 'Empty price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.AnotherCurrency',
			'value' => 'jiná měna',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.AnotherCurrency',
			'value' => 'other currency',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Currency',
			'value' => 'Měna:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Currency',
			'value' => 'Currency:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.CurrencyCourse',
			'value' => 'kurz:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.CurrencyCourse',
			'value' => 'course:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Date',
			'value' => 'Datum:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Date',
			'value' => 'Date:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Heading',
			'value' => 'Nový příjem',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Heading',
			'value' => 'Create new income',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Name',
			'value' => 'Krátký popis:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Name',
			'value' => 'Short description:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Name.Placeholder',
			'value' => 'výplata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Name.Placeholder',
			'value' => 'salary',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Price',
			'value' => 'Cena:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Price',
			'value' => 'Price:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Save',
			'value' => 'Vytvořit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Save',
			'value' => 'Store',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Type',
			'value' => 'Typ:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Type',
			'value' => 'Type:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Type.Card',
			'value' => 'Na kartu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Type.Card',
			'value' => 'To card',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Type.Cash',
			'value' => 'V hotovosti',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddIncome.Form.Type.Cash',
			'value' => 'In cash',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Course.Empty',
			'value' => 'Prázdný kurz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Course.Empty',
			'value' => 'Empty course',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Date.Empty',
			'value' => 'Prázdné datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Date.Empty',
			'value' => 'Empty date',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Name.Empty',
			'value' => 'Prázdné jméno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Name.Empty',
			'value' => 'Empty name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Note.NoNote',
			'value' => 'Nevybrán druh útraty. Nějaký si vyberte v nastavení.',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Note.NoNote',
			'value' => 'No note selected. Take some notes in settings.',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Price.BadFormat',
			'value' => 'Špatná cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Price.BadFormat',
			'value' => 'Wrong price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Price.Empty',
			'value' => 'Prázdná cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Error.Price.Empty',
			'value' => 'Empty price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.AnotherCurrency',
			'value' => 'jiná měna',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.AnotherCurrency',
			'value' => 'other currency',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.BadName',
			'value' => 'Vyplň název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.BadName',
			'value' => 'Fill name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.BadPrice',
			'value' => 'Vyplň cenu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.BadPrice',
			'value' => 'Fill price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Currency',
			'value' => 'Měna:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Currency',
			'value' => 'Currency:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.CurrencyCourse',
			'value' => 'kurz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.CurrencyCourse',
			'value' => 'course',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Date',
			'value' => 'Datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Date',
			'value' => 'Date',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Description',
			'value' => 'Popis',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Description',
			'value' => 'Description',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Description.Placeholder',
			'value' => 'popis',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Description.Placeholder',
			'value' => 'description',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Duplicity',
			'value' => 'Záznam již existuje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Duplicity',
			'value' => 'Item already exists',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Heading',
			'value' => 'Přidat novou položku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Heading',
			'value' => 'Add new item',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.MyExpense',
			'value' => 'ODEPSAT',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.MyExpense',
			'value' => 'WRITE OFF',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Name',
			'value' => 'Název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Name',
			'value' => 'Name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Name.Placeholder',
			'value' => 'název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Name.Placeholder',
			'value' => 'name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Note',
			'value' => 'Druh útraty',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Note',
			'value' => 'Note',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Pick',
			'value' => 'VÝBĚR Z BANKOMATU',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Pick',
			'value' => 'ATM PICK',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Price',
			'value' => 'Cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Price',
			'value' => 'Price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.RequiredField',
			'value' => 'Povinné pole',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.RequiredField',
			'value' => 'Required field',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Save',
			'value' => 'Nahrát',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Save',
			'value' => 'Store',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Success',
			'value' => 'Položka byla nahrána do databáze',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Success',
			'value' => 'Item was stored into database',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.SuccessButton',
			'value' => 'Přidat další položku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.SuccessButton',
			'value' => 'Add another item',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Type',
			'value' => 'Typ platby',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Type',
			'value' => 'Payment type',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Type.Card',
			'value' => 'Karta',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Type.Card',
			'value' => 'Card',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Type.Cash',
			'value' => 'Hotovost',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddItem.Form.Type.Cash',
			'value' => 'Cash',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.AddAnotherItem',
			'value' => 'Přidal talší položku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.AddAnotherItem',
			'value' => 'Add another item',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.AddedText',
			'value' => 'Transakce proběhla úspěně',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.AddedText',
			'value' => 'Transaction completed',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.BadPrice',
			'value' => 'Vyplň cenu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.BadPrice',
			'value' => 'Fill price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.BadReason',
			'value' => 'Vyplň důvod',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.BadReason',
			'value' => 'Fill reason',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Price',
			'value' => 'Věnovat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Price',
			'value' => 'Give',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.PriceNaN',
			'value' => 'Cena není číslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.PriceNaN',
			'value' => 'Price is not a number',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Reason',
			'value' => 'Důvod',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Reason',
			'value' => 'Reason',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Reason.Default',
			'value' => 'Max 60 zanků',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Reason.Default',
			'value' => 'Max 60 chars',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.ReasonBadLength',
			'value' => 'Důvod může mít nejvýe {%d} znaků',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.ReasonBadLength',
			'value' => 'Reason can have at least {%d} letters',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Send',
			'value' => 'Nahrát',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Send',
			'value' => 'Add',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Type',
			'value' => 'Na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Type',
			'value' => 'On',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Type.Card',
			'value' => 'Kartu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Type.Card',
			'value' => 'Card',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Type.Cash',
			'value' => 'V hotovosti',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.Type.Cash',
			'value' => 'Cash',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.UseDelimiter',
			'value' => 'Pro oddělení haléřů použij desetinnou tečku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Form.UseDelimiter',
			'value' => 'Use decimal point instead of comma',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Heading1',
			'value' => 'Přidat částku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Heading1',
			'value' => 'Add amount',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.SuccessMail.Message1',
			'value' => 'Bylo připsáno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.SuccessMail.Message1',
			'value' => 'Was credited',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.SuccessMail.Message2',
			'value' => 'Věc',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.SuccessMail.Message2',
			'value' => 'Purpose',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.SuccessMail.Subject',
			'value' => 'Transakce na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.SuccessMail.Subject',
			'value' => 'Transaction on',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Date',
			'value' => 'Datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Date',
			'value' => 'Date',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Delete',
			'value' => 'Smazat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Delete',
			'value' => 'Delete',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Delete.Title',
			'value' => 'Smazat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Delete.Title',
			'value' => 'Delete',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.ID',
			'value' => 'ID',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.ID',
			'value' => 'ID',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Reason',
			'value' => 'Důvod',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Reason',
			'value' => 'Reason',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Type',
			'value' => 'Typ',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Type',
			'value' => 'Type',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Value',
			'value' => 'Hodnota',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'AddTransaction.Table.Value',
			'value' => 'Amount',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Dashboard.AddWallet',
			'value' => 'Přidat peněženku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Dashboard.AddWallet',
			'value' => 'Add wallet',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Error.LoginAgain',
			'value' => 'Přihlašte se znova',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Error.LoginAgain',
			'value' => 'Log in again',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Error.LogInFirst',
			'value' => 'Nejdřív se přihlašte',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Error.LogInFirst',
			'value' => 'You have to login first',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Facebook.Error.AllowEmail',
			'value' => 'Musíte si na Facebooku povolit přístup k emailu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Facebook.Error.AllowEmail',
			'value' => 'You must allow your email in facebook',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Facebook.Error.AllowLocale',
			'value' => 'Musíte si na Facebooku povolit své údaje o poloze a státu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Facebook.Error.AllowLocale',
			'value' => 'You must allow your locale on Facebook',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Facebook.Error.AllowName',
			'value' => 'Musíte si nejprve povolit přístup ke jménu na facebooku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Facebook.Error.AllowName',
			'value' => 'You must allou your name in facebook',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Import.Description',
			'value' => 'Vložte soubor CSV, který jste si dříve stáhl(a)',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Import.Description',
			'value' => 'Load CSV file, which you previously download',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Import.Send',
			'value' => 'Nahrát',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Import.Send',
			'value' => 'Import',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Import.Title',
			'value' => 'Nahrát zálohu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Import.Title',
			'value' => 'Import backup',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Incomes.H2',
			'value' => 'Příjmy peněženky:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Incomes.H2',
			'value' => 'Incomes of wallet:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Item.Form.Required',
			'value' => 'Povinné položky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Item.Form.Required',
			'value' => 'Required fields',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Items.Loading.Alt',
			'value' => 'Načítání',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Items.Loading.Alt',
			'value' => 'Loading',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Admin',
			'value' => 'administrátor',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Admin',
			'value' => 'admin section',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.BadInput',
			'value' => 'Špatné přihlašovací údaje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.BadInput',
			'value' => 'Wrong login',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Mail.Message.Login',
			'value' => 'Login',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Mail.Message.Login',
			'value' => 'Login',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Mail.Message.Password',
			'value' => 'heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Mail.Message.Password',
			'value' => 'password',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Mail.Subject.AppName',
			'value' => 'Útrata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Mail.Subject.AppName',
			'value' => 'Charge',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Mail.Subject.Specification',
			'value' => 'zapomenuté údaje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Mail.Subject.Specification',
			'value' => 'forgotten login',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Headding1',
			'value' => 'Zapomenuté údaje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Headding1',
			'value' => 'Forgotten login',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Mail',
			'value' => 'Váš e-mail',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Mail',
			'value' => 'Your e-mail',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Send',
			'value' => 'Odeslat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Send',
			'value' => 'Send',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Status.EmptyMail',
			'value' => 'Vyplň mail',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Status.EmptyMail',
			'value' => 'Fill mail',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Status.Error',
			'value' => 'Něco se pokazilo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Status.Error',
			'value' => 'Something gone wrong',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Status.MailNotSent',
			'value' => 'Email se nepodařilo odeslat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Login.Forgotten.Modal.Status.MailNotSent',
			'value' => 'Can\'t send an e-mail',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.MorePeopleWithSameMail',
			'value' => 'Více lidí má stejný mail. Kontaktujte správce webu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.MorePeopleWithSameMail',
			'value' => 'More people has the same e-mail address. Contact the web admin',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.Nobody',
			'value' => 'Nikdo s takovým mailem není v databázi veden',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.Nobody',
			'value' => 'Nobody with this e-mail address exists',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.SQLStatementError',
			'value' => 'španý SQL příkaz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.SQLStatementError',
			'value' => 'bad SQL statement',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.Success',
			'value' => 'Přihlašovací údaje Vám byly zaslány na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.Success',
			'value' => 'Your login was sent to Your mail',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.ForgottenPassword',
			'value' => 'Zapomenuté přihlašovací údaje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.ForgottenPassword',
			'value' => 'Forgotten login',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Login',
			'value' => 'Jméno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Login',
			'value' => 'Name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.LogInto',
			'value' => 'Přihlásit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.LogInto',
			'value' => 'Log in',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Password',
			'value' => 'Heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Password',
			'value' => 'Password',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.SignIn',
			'value' => 'Registrovat se',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.SignIn',
			'value' => 'Sign in',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'MailEngine.FailToSend',
			'value' => 'E-mail se nepodařilo odeslat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'MailEngine.FailToSend',
			'value' => 'Cannot send an e-mail',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.AddButton',
			'value' => 'přidat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.AddButton',
			'value' => 'add',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.AddLabel',
			'value' => 'Přidat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.AddLabel',
			'value' => 'Add',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.Back',
			'value' => 'Zpět',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.Back',
			'value' => 'Back',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.DeleteNote',
			'value' => 'Smazat druh útraty',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.DeleteNote',
			'value' => 'Delete note',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.NoNote',
			'value' => 'Žádný druh útraty',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.NoNote',
			'value' => 'No one note',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.Table.Code',
			'value' => 'Kód',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.Table.Code',
			'value' => 'Code',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.Table.Name',
			'value' => 'Název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ManageNotes.Form.Table.Name',
			'value' => 'Name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.AddItem',
			'value' => 'Přidat položku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.AddItem',
			'value' => 'Add item',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Back',
			'value' => 'Zpět',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Back',
			'value' => 'Back',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.DownloadBackUp',
			'value' => 'Stáhnout zálohu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.DownloadBackUp',
			'value' => 'Download backup',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Home',
			'value' => 'Domů',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Home',
			'value' => 'Home',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Incomes',
			'value' => 'Příjmy',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Incomes',
			'value' => 'Incomes',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.LoadImport',
			'value' => 'Nahrát data',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.LoadImport',
			'value' => 'Load data',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Logout',
			'value' => 'Odhlásit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Logout',
			'value' => 'Logout',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.MothlyPreview',
			'value' => 'Měsíční přehled',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.MothlyPreview',
			'value' => 'Monthly preview',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.OldItems',
			'value' => 'Archiv',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.OldItems',
			'value' => 'Archive',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Settings',
			'value' => 'Nastavení',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Settings',
			'value' => 'Settings',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Shortcuts',
			'value' => 'klávesové zkratky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Shortcuts',
			'value' => 'shortcuts',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.ShortcutsTitle',
			'value' => 'Ctrl+, - nový záznam Ctrl+M - nová transakce Ctrl+O - archiv Ctrl+S - nastavení Ctrl+Z - zpět v historii Ctrl+Y - vpřed v historii Ctrl+B - zpět na hlavní',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.ShortcutsTitle',
			'value' => 'Ctrl+, - new item Ctrl+M - new transaction Ctrl+O - archive Ctrl+S - settings Ctrl+Z - back in history Ctrl+Y - front to history Ctrl+B - back Ctrl+L - lo',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.April',
			'value' => 'Duben',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.April',
			'value' => 'April',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.August',
			'value' => 'Srpen',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.August',
			'value' => 'August',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.December',
			'value' => 'Prosinec',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.December',
			'value' => 'December',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.February',
			'value' => 'Únor',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.February',
			'value' => 'February',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.January',
			'value' => 'Leden',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.January',
			'value' => 'January',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.July',
			'value' => 'Červenec',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.July',
			'value' => 'July',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.June',
			'value' => 'Červen',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.June',
			'value' => 'June',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.March',
			'value' => 'Březen',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.March',
			'value' => 'March',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.May',
			'value' => 'Květen',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.May',
			'value' => 'May',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.November',
			'value' => 'Listopad',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.November',
			'value' => 'November',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.October',
			'value' => 'Říjen',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.October',
			'value' => 'October',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.September',
			'value' => 'Září',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.September',
			'value' => 'September',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'No',
			'value' => 'NE',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'No',
			'value' => 'NO',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'OldItems.Heading1',
			'value' => 'Archiv',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'OldItems.Heading1',
			'value' => 'Archive',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.CheckedItemTitle',
			'value' => 'Přesunout do archivu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.CheckedItemTitle',
			'value' => 'Move to archive',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.DeleteItemTitle',
			'value' => 'Smazat záznam',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.DeleteItemTitle',
			'value' => 'Delete item',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Description',
			'value' => 'Bližší popis',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Description',
			'value' => 'Description',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Filtering.Error.TwoSpaces',
			'value' => 'Řetězec začínal dvěma mezarama!',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Filtering.Error.TwoSpaces',
			'value' => 'Pattern started with two spaces!',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.More.Button',
			'value' => 'Dalších',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.More.Button',
			'value' => 'More',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Name',
			'value' => 'Název položky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Name',
			'value' => 'Item name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.NoResults',
			'value' => 'Takovému výběru neodpovídají žádné výsledky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.NoResults',
			'value' => 'No results for this choice',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Note',
			'value' => 'Druh útraty',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Note',
			'value' => 'Note',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.PayedBy.Card',
			'value' => 'karta',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.PayedBy.Card',
			'value' => 'card',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.PayedBy.Cash',
			'value' => 'hotovost',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.PayedBy.Cash',
			'value' => 'cash',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Price',
			'value' => 'Celková cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Price',
			'value' => 'Total price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Status.Card',
			'value' => 'Rest on card',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Status.Cash',
			'value' => 'Rest in cash',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.TotalItemsPrice',
			'value' => 'SUM:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.TotalItemsPrice',
			'value' => 'SUM:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.TotalItemsSize',
			'value' => 'Celkem položek:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.TotalItemsSize',
			'value' => 'Total items:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Type',
			'value' => 'Placeno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Type',
			'value' => 'Payed by',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.UpdateItemTitle',
			'value' => 'Aktualizovat položku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.UpdateItemTitle',
			'value' => 'Update item',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Button',
			'value' => 'Náhled e-mailu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Button',
			'value' => 'E-mail preview',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.For',
			'value' => 'Za',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.For',
			'value' => 'For',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.FromMonth',
			'value' => 'Vyúčtování za',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.FromMonth',
			'value' => 'Audit for',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.FromYear',
			'value' => 'roku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.FromYear',
			'value' => 'of year',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.Intro',
			'value' => 'Text zprávy',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.Intro',
			'value' => 'Message content',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.Items',
			'value' => 'položek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.Items',
			'value' => 'items',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.ItemsCount',
			'value' => 'Počet položek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.ItemsCount',
			'value' => 'Number of items',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.Send',
			'value' => 'Opravdu poslat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.Send',
			'value' => 'Really send',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Sent.ToDate',
			'value' => 'Účetnictví za',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Sent.ToDate',
			'value' => 'Audit for',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Sent.ToMail',
			'value' => 'odesláno na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Sent.ToMail',
			'value' => 'send to',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Year',
			'value' => 'rok',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Year',
			'value' => 'year',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.Login',
			'value' => 'Špatně vyplněný login',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.Login',
			'value' => 'Wrong filled login',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.MailToParent',
			'value' => 'Špatně vyplněný mail na rodiče',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.MailToParent',
			'value' => 'Wrong filled mail to parent',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.Name',
			'value' => 'Špatně vyplněné jméno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.Name',
			'value' => 'Wrong filled name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.Password',
			'value' => 'Špatně vyplněné heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.Password',
			'value' => 'Wrong filled password',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.PasswordAgain',
			'value' => 'Špatně vyplněné heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.PasswordAgain',
			'value' => 'Wrong filled password',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Change',
			'value' => 'Změnit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Change',
			'value' => 'Change',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ChangePassword.CheckBox',
			'value' => 'Změnit heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ChangePassword.CheckBox',
			'value' => 'Change password',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ConfirmPassword',
			'value' => 'Potvrzení heslo:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ConfirmPassword',
			'value' => 'Confirm password:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ConfirmPassword.NotSame',
			'value' => 'hesla se neshodují',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ConfirmPassword.NotSame',
			'value' => 'passwords not match',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ConfirmPassword.Placeholder',
			'value' => 'heslo znova',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ConfirmPassword.Placeholder',
			'value' => 'password againn',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Currency',
			'value' => 'Měna:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Currency',
			'value' => 'Currency:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.FirstName',
			'value' => 'Jméno:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.FirstName',
			'value' => 'Name:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.FirstName.Empty',
			'value' => 'Prázdné jméno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.FirstName.Empty',
			'value' => 'Empty first name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.FirstName.Placeholder',
			'value' => 'Jan',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.FirstName.Placeholder',
			'value' => 'John',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Form.MyMail',
			'value' => 'Empty e-mail address',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Form.MyMail.Empty',
			'value' => 'Prázdná e-mailová adresa',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.KindsOfSpend',
			'value' => 'Druhy útraty:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.KindsOfSpend',
			'value' => 'Kind of charges:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Language',
			'value' => 'Jazyk:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Language',
			'value' => 'Language:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.LastName',
			'value' => 'Příjmení:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.LastName',
			'value' => 'Last name:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.LastName.Empty',
			'value' => 'Prázdné příjmení',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.LastName.Empty',
			'value' => 'Emty last name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.LastName.Placeholder',
			'value' => 'Novák',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.LastName.Placeholder',
			'value' => 'Doe',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login',
			'value' => 'Login:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login',
			'value' => 'Login:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login.AlreadyExists',
			'value' => 'Tato hodnota je již zabraná',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login.AlreadyExists',
			'value' => 'This value is already taken',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login.SomeError',
			'value' => 'Nějaká chyba',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login.SomeError',
			'value' => 'Some error',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login.TooShort',
			'value' => 'příliš krátké (< {%d} znaků)',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login.TooShort',
			'value' => 'too short (< {%d} chars)',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Mail.BadFormat',
			'value' => 'Špatný formát',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Mail.BadFormat',
			'value' => 'Wrong format',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.MailToMe',
			'value' => 'Mail na mě:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.MailToMe',
			'value' => 'Mail to me:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.MailToParent',
			'value' => 'Mail na rodiče:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.MailToParent',
			'value' => 'Mail to parent:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ManageNotes',
			'value' => 'Spravovat druhy útraty',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ManageNotes',
			'value' => 'Manage notes',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.NoteAdd.Empty',
			'value' => 'Prázdný druh útraty',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.NoteAdd.Empty',
			'value' => 'Empty kind of expende',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.OldPassword',
			'value' => 'Nynější heslo:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.OldPassword',
			'value' => 'Old password:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.OldPassword.Placeholder',
			'value' => 'heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.OldPassword.Placeholder',
			'value' => 'password',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password',
			'value' => 'Změna hesla:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password',
			'value' => 'Password change:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password.BadSecurity',
			'value' => 'Alespoň 2 vlastnosti z [a-z], [A-Z] a [0-9]',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password.BadSecurity',
			'value' => 'At least 2 property of [a-z], [A-Z] and [0-9]',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password.Placeholder',
			'value' => 'heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password.Placeholder',
			'value' => 'password',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password.TooShort',
			'value' => 'příliš krátké (< {%d} znaků)',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password.TooShort',
			'value' => 'too short (< {%d} chars)',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Result.Error',
			'value' => 'Něco se pokazilo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Result.Error',
			'value' => 'Something gone wrong',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Result.Success',
			'value' => 'Vše změněno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Result.Success',
			'value' => 'Everything changed',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.SendByOne',
			'value' => 'Posílat rodiči každou položku:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.SendByOne',
			'value' => 'Send to parent every added item:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.SendMonthly',
			'value' => 'Možnost posílat měsíční výpis:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.SendMonthly',
			'value' => 'Ability to send monthly expense:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Heading',
			'value' => 'nastavení',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Heading',
			'value' => 'settings',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ShowItems.CheckAll.Alert',
			'value' => 'Chcete přesunout do archivu všechny tyto položky?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ShowItems.CheckAll.Alert',
			'value' => 'Do you really want to archive all displayed items?',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ShowItems.CheckAll.Title',
			'value' => 'Přesunout do archivu všechny zobrazené',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ShowItems.CheckAll.Title',
			'value' => 'Archive all pisplayed items',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ShowItems.Delete.Alert',
			'value' => 'Opravdu chceš smazat?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ShowItems.Delete.Alert',
			'value' => 'Do you really want to delete this item?',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.Description',
			'value' => 'Zde se můžete podívat na statistiku, jak na tom tento měsíc jste vzhledem k předešlým měsícům. Vybrat si můžete, jestli chcete přehled konkrétního druhu útraty, či všeho.',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.Description',
			'value' => 'Here you can look at the statistics as of the month you are due to the previous months. Choose if you want to review a specific note or everything.',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.Filtering.NotesLabel',
			'value' => 'Statistika pro určitý druh útraty:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.Filtering.NotesLabel',
			'value' => 'Statistics for specific note:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.Filtering.Types.Default',
			'value' => '--druh útraty--',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.Filtering.Types.Default',
			'value' => '--note--',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Average',
			'value' => 'PRŮMĚRNĚ:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Average',
			'value' => 'AVERAGE:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Date',
			'value' => 'Měsíc',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Date',
			'value' => 'Month',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Max',
			'value' => 'MAX:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Max',
			'value' => 'MAX:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Min',
			'value' => 'MIN:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Min',
			'value' => 'MIN:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Percentage',
			'value' => 'Procento:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Percentage',
			'value' => 'Percentage',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.ThisMonth',
			'value' => 'Tento měsíc',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.ThisMonth',
			'value' => 'This month',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Value',
			'value' => 'Útrata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Value',
			'value' => 'Expense',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.H2',
			'value' => 'Srovnání s celými měsíci',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.H2',
			'value' => 'Comparsion with whole months',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.H1',
			'value' => 'Měsíční přehled peněženky:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.H1',
			'value' => 'Monthly preview of wallet:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Average',
			'value' => 'PRŮMĚR:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Average',
			'value' => 'AVERAGE:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Date',
			'value' => 'Měsíc',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Date',
			'value' => 'Month',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Max',
			'value' => 'MAX:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Max',
			'value' => 'MAX:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Min',
			'value' => 'MIN:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Min',
			'value' => 'MIN:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Percentage',
			'value' => 'Procento',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Percentage',
			'value' => 'Percentage',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.ThisMonth',
			'value' => 'Tento měsíc',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.ThisMonth',
			'value' => 'This month',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Value',
			'value' => 'Útrata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Value',
			'value' => 'Expense',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.H2',
			'value' => 'Srovnání s měsíci do {%d}. každého měsíce',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.H2',
			'value' => 'Comparsion with months since {%d}th of each month',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.Expense',
			'value' => 'Útrata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.Expense',
			'value' => 'Expense',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.ExpensesCnt',
			'value' => 'položek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.ExpensesCnt',
			'value' => '#expenses',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.Income',
			'value' => 'Příjem',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.Income',
			'value' => 'Income',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.IncomesCnt',
			'value' => 'položek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.IncomesCnt',
			'value' => '#incomes',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.Percentage',
			'value' => 'Procento',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.Percentage',
			'value' => 'Percentage',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.Season',
			'value' => 'Měsíc',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.Season',
			'value' => 'Month',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.ThisMonth',
			'value' => 'Útrata tohoto měsíce',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TableFull.Head.ThisMonth',
			'value' => 'Expense of this month',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.Expense',
			'value' => 'Útrata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.Expense',
			'value' => 'Monthly expense',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.ExpensesCnt',
			'value' => 'položek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.ExpensesCnt',
			'value' => '#expenses',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.Income',
			'value' => 'Příjem',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.Income',
			'value' => 'Monthly income',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.IncomesCnt',
			'value' => 'položek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.IncomesCnt',
			'value' => '#incomes',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.Percentage',
			'value' => 'Procento',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.Percentage',
			'value' => 'Percentage',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.Season',
			'value' => 'Měsíc',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.Season',
			'value' => 'Month',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.ThisMonth',
			'value' => 'Útrata tohoto měsíce',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Statistics.TablePart.Head.ThisMonth',
			'value' => 'Expense of this month',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Status.Card',
			'value' => 'Zůstatek na kartě',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Status.Cash',
			'value' => 'Zůstatek v hotovosti',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Title',
			'value' => ' - útrata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
		'TranslationCode' => 'Title',
			'value' => '\'s expense',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Course.Empty',
			'value' => 'Prázdný kurz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Course.Empty',
			'value' => 'Empty course',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Date.Empty',
			'value' => 'Nevyplněný datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Date.Empty',
			'value' => 'Empty date',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Name.Empty',
			'value' => 'Prázdný název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Name.Empty',
			'value' => 'Empty name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Price.BadFormat',
			'value' => 'Cena ve špatném formátu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Price.BadFormat',
			'value' => 'Price in bad format',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Price.Empty',
			'value' => 'Prázdná cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Price.Empty',
			'value' => 'Empty price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.AnotherCurrency',
			'value' => 'jiná měna',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.AnotherCurrency',
			'value' => 'other currency',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Currency',
			'value' => 'Měna:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Currency',
			'value' => 'Currency:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.CurrencyCourse',
			'value' => 'kurz:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.CurrencyCourse',
			'value' => 'course:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Date',
			'value' => 'Datum:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Date',
			'value' => 'Date:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Heading',
			'value' => 'Upravit příjem',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Heading',
			'value' => 'Change income',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Name',
			'value' => 'Krátký popis:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Name',
			'value' => 'Short description:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Price',
			'value' => 'Cena:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Price',
			'value' => 'Price:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Save',
			'value' => 'Vytvořit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Save',
			'value' => 'Store',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Type',
			'value' => 'Typ:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Type',
			'value' => 'Type:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Type.Card',
			'value' => 'Na kartu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Type.Card',
			'value' => 'To card',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Type.Cash',
			'value' => 'V hotovosti',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Type.Cash',
			'value' => 'In cash',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Wallet',
			'value' => 'Peněženka:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Wallet',
			'value' => 'Wallet:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.AlreadyUpdating',
			'value' => 'Již se aktualizuje položka',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.AlreadyUpdating',
			'value' => 'Update already in progress',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Course.Empty',
			'value' => 'Prázdný kurz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Course.Empty',
			'value' => 'Empty course',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Date.Empty',
			'value' => 'Prázdné datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Date.Empty',
			'value' => 'Empty date',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Name.Empty',
			'value' => 'Prázdné jméno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Name.Empty',
			'value' => 'Empty name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Price.BadFormat',
			'value' => 'Špatná cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Price.BadFormat',
			'value' => 'Wrong price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Price.Empty',
			'value' => 'Prázdná cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Price.Empty',
			'value' => 'Empty price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.AnotherCurrency',
			'value' => 'jiná měna',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.AnotherCurrency',
			'value' => 'other currency',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Course',
			'value' => 'kurz:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Course',
			'value' => 'course:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Currency',
			'value' => 'Měna:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Currency',
			'value' => 'Currency:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Date',
			'value' => 'Datum:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Date',
			'value' => 'Date:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Description',
			'value' => 'Popis:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Description',
			'value' => 'Description:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Heading',
			'value' => 'Úprava položky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Heading',
			'value' => 'Update item form',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Name',
			'value' => 'Název:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Name',
			'value' => 'Name:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Odepsat',
			'value' => 'Odepsat:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Odepsat',
			'value' => 'My expense:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Price',
			'value' => 'Cena:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Price',
			'value' => 'Price:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Purpose',
			'value' => 'Druh útraty:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Purpose',
			'value' => 'Note:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Save',
			'value' => 'Upravit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Save',
			'value' => 'Update',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Type',
			'value' => 'Typ:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Type',
			'value' => 'Type:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Type.Card',
			'value' => 'Karta',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Type.Card',
			'value' => 'Card',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Type.Cash',
			'value' => 'Hotovost',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Type.Cash',
			'value' => 'Cash',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Wallet',
			'value' => 'Peněženka:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Wallet',
			'value' => 'Wallet:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Update',
			'value' => 'Uložit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Update',
			'value' => 'Save',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Error.Again',
			'value' => 'Chyba při načítání souboru. Zkuste to prosím později',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Error.Again',
			'value' => 'Error durning uploading file. Please try it again',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Error.NoCSV',
			'value' => 'Soubor není typu CSV',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Error.NoCSV',
			'value' => 'The file is not of CSV type',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Error.NoFile',
			'value' => 'Vyberte nějaký soubor',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Error.NoFile',
			'value' => 'Must choose some file',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Success',
			'value' => 'Soubor nahrán',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Success',
			'value' => 'File uploaded',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Upload.Button',
			'value' => 'Vybrat soubor',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Upload.Button',
			'value' => 'Choose file',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.DownloadBackUp.ErrorOcured',
			'value' => 'Vyskytla se chyba',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.DownloadBackUp.ErrorOcured',
			'value' => 'Error ocures',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.AndMonth',
			'value' => 'a vybrat pouze',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.AndMonth',
			'value' => 'and select only',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.HelpTitle',
			'value' => 'jednotlivé řetězce oddělujte dvěma mezerama, pro napsání dvou mezer napiště \'\\ \\ \'.&#010;\'!\' před řetězcem - řetězec, který se v položce nikde nevyskytuje. Pro napsání vykřičníku použijte výraz \'\\!\'',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.HelpTitle',
			'value' => 'Every string delimite by two spaces, for typing two spaces type \'\\ \\ \'.&#010;\'!\' before string - string which is nowhere in every item for typing exclamation mark use expresion \'\\!\'',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Month.Default',
			'value' => '--měsíc--',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Month.Default',
			'value' => '--month--',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Or',
			'value' => 'nebo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Or',
			'value' => 'or',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy',
			'value' => 'Řadit podle',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy',
			'value' => 'Order by',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.Asc',
			'value' => 'Vzestupně',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.Asc',
			'value' => 'Ascendant',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.Desc',
			'value' => 'Sestupně',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.Desc',
			'value' => 'Descendant',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemDate',
			'value' => 'Datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemDate',
			'value' => 'Date',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemName',
			'value' => 'Název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemName',
			'value' => 'Name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemPrice',
			'value' => 'Cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemPrice',
			'value' => 'Price',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Pattern',
			'value' => 'slovo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Pattern',
			'value' => 'pattern',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.SetDefaultTitle',
			'value' => 'výchozí filtrování',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.SetDefaultTitle',
			'value' => 'default filtering',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Types.Default',
			'value' => '- druh útraty -',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Types.Default',
			'value' => '- note -',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Year',
			'value' => 'rok',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Year',
			'value' => 'year',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Heading1',
			'value' => 'útrata :-)',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Heading1',
			'value' => 'charges :-)',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.CreateBtn',
			'value' => 'Vytvořit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.CreateBtn',
			'value' => 'Create',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Error.Empty',
			'value' => 'Prázdné jméno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Error.Empty',
			'value' => 'Empty name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Name',
			'value' => 'Název:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Name',
			'value' => 'Name:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Name.Placeholder',
			'value' => 'název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Name.Placeholder',
			'value' => 'name',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Title',
			'value' => 'Přidat novou peněženku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Title',
			'value' => 'Add new Wallet',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.DeleteBtn.Title',
			'value' => 'Smazat peněženku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.DeleteBtn.Title',
			'value' => 'Delete wallet',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.H2',
			'value' => 'Výdaje peněženky:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.H2',
			'value' => 'Expenses of wallet:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.H2.OldItems',
			'value' => 'Archivované výdaje peněženky:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.H2.OldItems',
			'value' => 'Archived expenses of wallet:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.Card',
			'value' => 'Na kartě:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.Card',
			'value' => 'On card:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.Cash',
			'value' => 'V hotovosti:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.Cash',
			'value' => 'In cash:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.Items',
			'value' => 'Položek:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.Items',
			'value' => 'Items:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.PerMonth',
			'value' => 'Tento měsíc:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.PerMonth',
			'value' => 'This month:',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.UpdateBtn.Title',
			'value' => 'Modifikovat peněženku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.UpdateBtn.Title',
			'value' => 'Update wallet',
			'LanguageCode' => 'ENG',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Yes',
			'value' => 'ANO',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Yes',
			'value' => 'YES',
			'LanguageCode' => 'ENG',
		]);
		*/
	}
}
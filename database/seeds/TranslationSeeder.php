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
		$this->prepareData();
		DB::table('utrata_translations')->insert($this->data);
	}
  
	private $data = [];

	private function prepareData() {
		$this->data = [
	    	[
				'TranslationCode' => 'Add',
				'value' => 'Jiná měna',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'AddIncome.Error.Course.Empty',
				'value' => 'Nevyplněný kurz',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Error.Course.Empty',
				'value' => 'Empty course',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Error.Date.Empty',
				'value' => 'Nevyplněný datum',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Error.Date.Empty',
				'value' => 'Empty date',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Error.Name.Empty',
				'value' => 'Nevyplněný název',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Error.Name.Empty',
				'value' => 'Empty name',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Error.Price.BadFormat',
				'value' => 'Cena ve špatném formátu',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Error.Price.BadFormat',
				'value' => 'Price in bad format',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Error.Price.Empty',
				'value' => 'Nevyplněná cena',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Error.Price.Empty',
				'value' => 'Empty price',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.AnotherCurrency',
				'value' => 'jiná měna',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.AnotherCurrency',
				'value' => 'other currency',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Currency',
				'value' => 'Měna:',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Currency',
				'value' => 'Currency:',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.CurrencyCourse',
				'value' => 'kurz:',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.CurrencyCourse',
				'value' => 'course:',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Date',
				'value' => 'Datum:',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Date',
				'value' => 'Date:',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Heading',
				'value' => 'Nový příjem',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Heading',
				'value' => 'Create new income',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Name',
				'value' => 'Krátký popis:',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Name',
				'value' => 'Short description:',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Name.Placeholder',
				'value' => 'výplata',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Name.Placeholder',
				'value' => 'salary',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Price',
				'value' => 'Cena:',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Price',
				'value' => 'Price:',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Save',
				'value' => 'Vytvořit',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Save',
				'value' => 'Store',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Type',
				'value' => 'Typ:',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Type',
				'value' => 'Type:',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Type.Card',
				'value' => 'Na kartu',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Type.Card',
				'value' => 'To card',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Type.Cash',
				'value' => 'V hotovosti',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddIncome.Form.Type.Cash',
				'value' => 'In cash',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Error.Course.Empty',
				'value' => 'Nevyplněný kurz',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Error.Course.Empty',
				'value' => 'Empty course',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Error.Date.Empty',
				'value' => 'Nevyplněný datum',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Error.Date.Empty',
				'value' => 'Empty date',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Error.Name.Empty',
				'value' => 'Nevyplněné jméno',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Error.Name.Empty',
				'value' => 'Empty name',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Error.Note.NoNote',
				'value' => 'Nevybrán druh útraty. Nějaký si vyberte v nastavení.',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Error.Note.NoNote',
				'value' => 'No note selected. Take some notes in settings.',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Error.Price.BadFormat',
				'value' => 'Špatná cena',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Error.Price.BadFormat',
				'value' => 'Wrong price',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Error.Price.Empty',
				'value' => 'Nevyplněná cena',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Error.Price.Empty',
				'value' => 'Empty price',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.AnotherCurrency',
				'value' => 'jiná měna',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.AnotherCurrency',
				'value' => 'other currency',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.BadName',
				'value' => 'Vyplň název',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.BadName',
				'value' => 'Fill name',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.BadPrice',
				'value' => 'Vyplň cenu',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.BadPrice',
				'value' => 'Fill price',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Currency',
				'value' => 'Měna:',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Currency',
				'value' => 'Currency:',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.CurrencyCourse',
				'value' => 'kurz',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.CurrencyCourse',
				'value' => 'course',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Date',
				'value' => 'Datum',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Date',
				'value' => 'Date',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Description',
				'value' => 'Popis',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Description',
				'value' => 'Description',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Description.Placeholder',
				'value' => 'popis',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Description.Placeholder',
				'value' => 'description',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Duplicity',
				'value' => 'Záznam již existuje',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Duplicity',
				'value' => 'Item already exists',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Heading',
				'value' => 'Přidat novou položku',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Heading',
				'value' => 'Add new item',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.MyExpense',
				'value' => 'ODEPSAT',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.MyExpense',
				'value' => 'WRITE OFF',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Name',
				'value' => 'Název',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Name',
				'value' => 'Name',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Name.Placeholder',
				'value' => 'název',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Name.Placeholder',
				'value' => 'name',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Note',
				'value' => 'Druh útraty',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Note',
				'value' => 'Note',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Pick',
				'value' => 'VÝBĚR Z BANKOMATU',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Pick',
				'value' => 'ATM PICK',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Price',
				'value' => 'Cena',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Price',
				'value' => 'Price',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.RequiredField',
				'value' => 'Povinné pole',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.RequiredField',
				'value' => 'Required field',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Save',
				'value' => 'Nahrát',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Save',
				'value' => 'Store',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Success',
				'value' => 'Položka byla nahrána do databáze',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Success',
				'value' => 'Item was stored into database',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.SuccessButton',
				'value' => 'Přidat další položku',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.SuccessButton',
				'value' => 'Add another item',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Type',
				'value' => 'Typ platby',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Type',
				'value' => 'Payment type',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Type.Card',
				'value' => 'Karta',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Type.Card',
				'value' => 'Card',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddItem.Form.Type.Cash',
				'value' => 'Hotovost',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddItem.Form.Type.Cash',
				'value' => 'Cash',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.AddAnotherItem',
				'value' => 'Přidal talší položku',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.AddAnotherItem',
				'value' => 'Add another item',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.AddedText',
				'value' => 'Transakce proběhla úspěně',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.AddedText',
				'value' => 'Transaction completed',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.BadPrice',
				'value' => 'Vyplň cenu',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.BadPrice',
				'value' => 'Fill price',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.BadReason',
				'value' => 'Vyplň důvod',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.BadReason',
				'value' => 'Fill reason',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Price',
				'value' => 'Věnovat',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Price',
				'value' => 'Give',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.PriceNaN',
				'value' => 'Cena není číslo',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.PriceNaN',
				'value' => 'Price is not a number',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Reason',
				'value' => 'Důvod',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Reason',
				'value' => 'Reason',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Reason.Default',
				'value' => 'Max 60 zanků',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Reason.Default',
				'value' => 'Max 60 chars',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.ReasonBadLength',
				'value' => 'Důvod může mít nejvýe {%d} znaků',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.ReasonBadLength',
				'value' => 'Reason can have at least {%d} letters',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Send',
				'value' => 'Nahrát',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Send',
				'value' => 'Add',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Type',
				'value' => 'Na',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Type',
				'value' => 'On',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Type.Card',
				'value' => 'Kartu',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Type.Card',
				'value' => 'Card',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Type.Cash',
				'value' => 'V hotovosti',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.Type.Cash',
				'value' => 'Cash',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.UseDelimiter',
				'value' => 'Pro oddělení haléřů použij desetinnou tečku',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Form.UseDelimiter',
				'value' => 'Use decimal point instead of comma',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Heading1',
				'value' => 'Přidat částku',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Heading1',
				'value' => 'Add amount',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.SuccessMail.Message1',
				'value' => 'Bylo připsáno',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.SuccessMail.Message1',
				'value' => 'Was credited',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.SuccessMail.Message2',
				'value' => 'Věc',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.SuccessMail.Message2',
				'value' => 'Purpose',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.SuccessMail.Subject',
				'value' => 'Transakce na',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.SuccessMail.Subject',
				'value' => 'Transaction on',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Date',
				'value' => 'Datum',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Date',
				'value' => 'Date',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Delete',
				'value' => 'Smazat',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Delete',
				'value' => 'Delete',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Delete.Title',
				'value' => 'Smazat',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Delete.Title',
				'value' => 'Delete',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.ID',
				'value' => 'ID',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.ID',
				'value' => 'ID',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Reason',
				'value' => 'Důvod',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Reason',
				'value' => 'Reason',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Type',
				'value' => 'Typ',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Type',
				'value' => 'Type',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Value',
				'value' => 'Hodnota',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'AddTransaction.Table.Value',
				'value' => 'Amount',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Dashboard.AddWallet',
				'value' => 'Přidat peněženku',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Dashboard.AddWallet',
				'value' => 'Add wallet',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Error.LoginAgain',
				'value' => 'Přihlašte se znova',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Error.LoginAgain',
				'value' => 'Log in again',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Error.LogInFirst',
				'value' => 'Nejdřív se přihlašte',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Error.LogInFirst',
				'value' => 'You have to login first',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Facebook.Error.AllowEmail',
				'value' => 'Musíte si na Facebooku povolit přístup k emailu',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Facebook.Error.AllowEmail',
				'value' => 'You must allow your email in facebook',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Facebook.Error.AllowLocale',
				'value' => 'Musíte si na Facebooku povolit své údaje o poloze a státu',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Facebook.Error.AllowLocale',
				'value' => 'You must allow your locale on Facebook',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Facebook.Error.AllowName',
				'value' => 'Musíte si nejprve povolit přístup ke jménu na facebooku',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Facebook.Error.AllowName',
				'value' => 'You must allou your name in facebook',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Import.Description',
				'value' => 'Vložte soubor CSV, který jste si dříve stáhl(a)',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Import.Description',
				'value' => 'Load CSV file, which you previously download',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Import.Send',
				'value' => 'Nahrát',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Import.Send',
				'value' => 'Import',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Import.Title',
				'value' => 'Nahrát zálohu',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Import.Title',
				'value' => 'Import backup',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Incomes.H2',
				'value' => 'Příjmy peněženky:',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Incomes.H2',
				'value' => 'Incomes of wallet:',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Item.Form.Required',
				'value' => 'Povinné položky',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Item.Form.Required',
				'value' => 'Required fields',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Items.Loading.Alt',
				'value' => 'Načítání',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Items.Loading.Alt',
				'value' => 'Loading',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Admin',
				'value' => 'administrátor',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Admin',
				'value' => 'admin section',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.BadInput',
				'value' => 'Špatné přihlašovací údaje',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.BadInput',
				'value' => 'Wrong login',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Mail.Message.Login',
				'value' => 'Login',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Mail.Message.Login',
				'value' => 'Login',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Mail.Message.Password',
				'value' => 'heslo',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Mail.Message.Password',
				'value' => 'password',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Mail.Subject.AppName',
				'value' => 'Útrata',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Mail.Subject.AppName',
				'value' => 'Charge',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Mail.Subject.Specification',
				'value' => 'zapomenuté údaje',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Mail.Subject.Specification',
				'value' => 'forgotten login',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Headding1',
				'value' => 'Zapomenuté údaje',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Headding1',
				'value' => 'Forgotten login',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Mail',
				'value' => 'Váš e-mail',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Mail',
				'value' => 'Your e-mail',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Send',
				'value' => 'Odeslat',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Send',
				'value' => 'Send',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Status.EmptyMail',
				'value' => 'Vyplň mail',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Status.EmptyMail',
				'value' => 'Fill mail',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Status.Error',
				'value' => 'Něco se pokazilo',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Status.Error',
				'value' => 'Something gone wrong',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Status.MailNotSent',
				'value' => 'Email se nepodařilo odeslat',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Login.Forgotten.Modal.Status.MailNotSent',
				'value' => 'Can\'t send an e-mail',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.Forgotten.Modal.Status.MorePeopleWithSameMail',
				'value' => 'Více lidí má stejný mail. Kontaktujte správce webu',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.Forgotten.Modal.Status.MorePeopleWithSameMail',
				'value' => 'More people has the same e-mail address. Contact the web admin',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.Forgotten.Modal.Status.Nobody',
				'value' => 'Nikdo s takovým mailem není v databázi veden',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.Forgotten.Modal.Status.Nobody',
				'value' => 'Nobody with this e-mail address exists',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.Forgotten.Modal.Status.SQLStatementError',
				'value' => 'španý SQL příkaz',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.Forgotten.Modal.Status.SQLStatementError',
				'value' => 'bad SQL statement',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.Forgotten.Modal.Status.Success',
				'value' => 'Přihlašovací údaje Vám byly zaslány na',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.Forgotten.Modal.Status.Success',
				'value' => 'Your login was sent to Your mail',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.ForgottenPassword',
				'value' => 'Zapomenuté přihlašovací údaje',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.ForgottenPassword',
				'value' => 'Forgotten login',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.Login',
				'value' => 'Jméno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.Login',
				'value' => 'Name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.LogInto',
				'value' => 'Přihlásit',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.LogInto',
				'value' => 'Log in',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.Password',
				'value' => 'Heslo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.Password',
				'value' => 'Password',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.SignIn',
				'value' => 'Registrovat se',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.SignIn',
				'value' => 'Sign in',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'MailEngine.FailToSend',
				'value' => 'E-mail se nepodařilo odeslat',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'MailEngine.FailToSend',
				'value' => 'Cannot send an e-mail',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.AddButton',
				'value' => 'přidat',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.AddButton',
				'value' => 'add',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.AddLabel',
				'value' => 'Přidat',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.AddLabel',
				'value' => 'Add',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.Back',
				'value' => 'Zpět',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.Back',
				'value' => 'Back',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.DeleteNote',
				'value' => 'Smazat druh útraty',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.DeleteNote',
				'value' => 'Delete note',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.NoNote',
				'value' => 'Žádný druh útraty',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.NoNote',
				'value' => 'No one note',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.Table.Code',
				'value' => 'Kód',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.Table.Code',
				'value' => 'Code',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.Table.Name',
				'value' => 'Název',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ManageNotes.Form.Table.Name',
				'value' => 'Name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.AddItem',
				'value' => 'Přidat položku',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.AddItem',
				'value' => 'Add item',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.Back',
				'value' => 'Zpět',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.Back',
				'value' => 'Back',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.DownloadBackUp',
				'value' => 'Stáhnout zálohu',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.DownloadBackUp',
				'value' => 'Download backup',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.Home',
				'value' => 'Domů',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.Home',
				'value' => 'Home',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.Incomes',
				'value' => 'Příjmy',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.Incomes',
				'value' => 'Incomes',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.LoadImport',
				'value' => 'Nahrát data',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.LoadImport',
				'value' => 'Load data',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.Logout',
				'value' => 'Odhlásit',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.Logout',
				'value' => 'Logout',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.MonthlyPreview',
				'value' => 'Měsíční přehled',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.MonthlyPreview',
				'value' => 'Monthly preview',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.OldItems',
				'value' => 'Archiv',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.OldItems',
				'value' => 'Archive',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.Settings',
				'value' => 'Nastavení',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.Settings',
				'value' => 'Settings',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.Shortcuts',
				'value' => 'klávesové zkratky',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.Shortcuts',
				'value' => 'shortcuts',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Menu.ShortcutsTitle',
				'value' => 'Ctrl+, - nový záznam Ctrl+M - nová transakce Ctrl+O - archiv Ctrl+S - nastavení Ctrl+Z - zpět v historii Ctrl+Y - vpřed v historii Ctrl+B - zpět na hlavní',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Menu.ShortcutsTitle',
				'value' => 'Ctrl+, - new item Ctrl+M - new transaction Ctrl+O - archive Ctrl+S - settings Ctrl+Z - back in history Ctrl+Y - front to history Ctrl+B - back Ctrl+L - lo',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.April',
				'value' => 'Duben',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.April',
				'value' => 'April',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.August',
				'value' => 'Srpen',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.August',
				'value' => 'August',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.December',
				'value' => 'Prosinec',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.December',
				'value' => 'December',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.February',
				'value' => 'Únor',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.February',
				'value' => 'February',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.January',
				'value' => 'Leden',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.January',
				'value' => 'January',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.July',
				'value' => 'Červenec',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.July',
				'value' => 'July',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.June',
				'value' => 'Červen',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.June',
				'value' => 'June',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.March',
				'value' => 'Březen',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.March',
				'value' => 'March',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.May',
				'value' => 'Květen',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.May',
				'value' => 'May',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.November',
				'value' => 'Listopad',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.November',
				'value' => 'November',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.October',
				'value' => 'Říjen',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.October',
				'value' => 'October',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Month.September',
				'value' => 'Září',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Month.September',
				'value' => 'September',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'No',
				'value' => 'NE',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'No',
				'value' => 'NO',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'OldItems.Heading1',
				'value' => 'Archiv',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'OldItems.Heading1',
				'value' => 'Archive',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.CheckedItemTitle',
				'value' => 'Přesunout do archivu',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.CheckedItemTitle',
				'value' => 'Move to archive',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.DeleteItemTitle',
				'value' => 'Smazat záznam',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.DeleteItemTitle',
				'value' => 'Delete item',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.Description',
				'value' => 'Bližší popis',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.Description',
				'value' => 'Description',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.Filtering.Error.TwoSpaces',
				'value' => 'Řetězec začínal dvěma mezarama!',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.Filtering.Error.TwoSpaces',
				'value' => 'Pattern started with two spaces!',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.More.Button',
				'value' => 'Dalších',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.More.Button',
				'value' => 'More',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.Name',
				'value' => 'Název položky',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.Name',
				'value' => 'Item name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.NoResults',
				'value' => 'Takovému výběru neodpovídají žádné výsledky',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.NoResults',
				'value' => 'No results for this choice',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.Note',
				'value' => 'Druh útraty',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.Note',
				'value' => 'Note',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.PayedBy.Card',
				'value' => 'karta',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.PayedBy.Card',
				'value' => 'card',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.PayedBy.Cash',
				'value' => 'hotovost',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.PayedBy.Cash',
				'value' => 'cash',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.Price',
				'value' => 'Celková cena',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.Price',
				'value' => 'Total price',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.Status.Card',
				'value' => 'Rest on card',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.Status.Cash',
				'value' => 'Rest in cash',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.TotalItemsPrice',
				'value' => 'SUM:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.TotalItemsPrice',
				'value' => 'SUM:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.TotalItemsSize',
				'value' => 'Celkem položek:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.TotalItemsSize',
				'value' => 'Total items:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.Type',
				'value' => 'Placeno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.Type',
				'value' => 'Payed by',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'PrintItems.UpdateItemTitle',
				'value' => 'Aktualizovat položku',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'PrintItems.UpdateItemTitle',
				'value' => 'Update item',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Button',
				'value' => 'Náhled e-mailu',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Button',
				'value' => 'E-mail preview',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.For',
				'value' => 'Za',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.For',
				'value' => 'For',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.FromMonth',
				'value' => 'Vyúčtování za',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.FromMonth',
				'value' => 'Audit for',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.FromYear',
				'value' => 'roku',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.FromYear',
				'value' => 'of year',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.Intro',
				'value' => 'Text zprávy',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.Intro',
				'value' => 'Message content',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.Items',
				'value' => 'položek',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.Items',
				'value' => 'items',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.ItemsCount',
				'value' => 'Počet položek',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.ItemsCount',
				'value' => 'Number of items',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.Send',
				'value' => 'Opravdu poslat',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Preview.Send',
				'value' => 'Really send',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Sent.ToDate',
				'value' => 'Účetnictví za',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Sent.ToDate',
				'value' => 'Audit for',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Sent.ToMail',
				'value' => 'odesláno na',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Sent.ToMail',
				'value' => 'send to',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'SendToParent.Year',
				'value' => 'rok',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'SendToParent.Year',
				'value' => 'year',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.Login',
				'value' => 'Špatně vyplněný login',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.Login',
				'value' => 'Wrong filled login',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.MailToParent',
				'value' => 'Špatně vyplněný mail na rodiče',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.MailToParent',
				'value' => 'Wrong filled mail to parent',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.Name',
				'value' => 'Špatně vyplněné jméno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.Name',
				'value' => 'Wrong filled name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.Password',
				'value' => 'Špatně vyplněné heslo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.Password',
				'value' => 'Wrong filled password',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.PasswordAgain',
				'value' => 'Špatně vyplněné heslo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Alert.PasswordAgain',
				'value' => 'Wrong filled password',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Change',
				'value' => 'Změnit',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Change',
				'value' => 'Change',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.ChangePassword.CheckBox',
				'value' => 'Změnit heslo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.ChangePassword.CheckBox',
				'value' => 'Change password',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.ConfirmPassword',
				'value' => 'Potvrzení heslo:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.ConfirmPassword',
				'value' => 'Confirm password:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.ConfirmPassword.NotSame',
				'value' => 'hesla se neshodují',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.ConfirmPassword.NotSame',
				'value' => 'passwords not match',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.ConfirmPassword.Placeholder',
				'value' => 'heslo znova',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.ConfirmPassword.Placeholder',
				'value' => 'password againn',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Currency',
				'value' => 'Měna:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Currency',
				'value' => 'Currency:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.FirstName',
				'value' => 'Jméno:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.FirstName',
				'value' => 'Name:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.FirstName.Empty',
				'value' => 'Nevyplněné jméno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.FirstName.Empty',
				'value' => 'Empty first name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.FirstName.Placeholder',
				'value' => 'Jan',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.FirstName.Placeholder',
				'value' => 'John',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Form.MyMail',
				'value' => 'Empty e-mail address',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Form.MyMail.Empty',
				'value' => 'Nevyplněná e-mailová adresa',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.KindsOfSpend',
				'value' => 'Druhy útraty:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.KindsOfSpend',
				'value' => 'Kind of charges:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Language',
				'value' => 'Jazyk:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Language',
				'value' => 'Language:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.LastName',
				'value' => 'Příjmení:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.LastName',
				'value' => 'Last name:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.LastName.Empty',
				'value' => 'Nevyplněné příjmení',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.LastName.Empty',
				'value' => 'Emty last name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.LastName.Placeholder',
				'value' => 'Novák',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.LastName.Placeholder',
				'value' => 'Doe',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Login',
				'value' => 'Login:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Login',
				'value' => 'Login:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Login.AlreadyExists',
				'value' => 'Tato hodnota je již zabraná',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Login.AlreadyExists',
				'value' => 'This value is already taken',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Login.SomeError',
				'value' => 'Nějaká chyba',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Login.SomeError',
				'value' => 'Some error',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Login.TooShort',
				'value' => 'příliš krátké (< {%d} znaků)',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Login.TooShort',
				'value' => 'too short (< {%d} chars)',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Mail.BadFormat',
				'value' => 'Špatný formát',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Mail.BadFormat',
				'value' => 'Wrong format',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.MailToMe',
				'value' => 'Mail na mě:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.MailToMe',
				'value' => 'Mail to me:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.MailToParent',
				'value' => 'Mail na rodiče:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.MailToParent',
				'value' => 'Mail to parent:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.ManageNotes',
				'value' => 'Spravovat druhy útraty',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.ManageNotes',
				'value' => 'Manage notes',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.NoteAdd.Empty',
				'value' => 'Nevyplněný druh útraty',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.NoteAdd.Empty',
				'value' => 'Empty kind of expende',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.OldPassword',
				'value' => 'Nynější heslo:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.OldPassword',
				'value' => 'Old password:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.OldPassword.Placeholder',
				'value' => 'heslo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.OldPassword.Placeholder',
				'value' => 'password',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Password',
				'value' => 'Změna hesla:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Password',
				'value' => 'Password change:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Password.BadSecurity',
				'value' => 'Alespoň 2 vlastnosti z [a-z], [A-Z] a [0-9]',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Password.BadSecurity',
				'value' => 'At least 2 property of [a-z], [A-Z] and [0-9]',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Password.Placeholder',
				'value' => 'heslo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Password.Placeholder',
				'value' => 'password',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Password.TooShort',
				'value' => 'příliš krátké (< {%d} znaků)',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Password.TooShort',
				'value' => 'too short (< {%d} chars)',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Result.Error',
				'value' => 'Něco se pokazilo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Result.Error',
				'value' => 'Something gone wrong',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.Result.Success',
				'value' => 'Vše změněno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.Result.Success',
				'value' => 'Everything changed',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.SendByOne',
				'value' => 'Posílat rodiči každou položku:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.SendByOne',
				'value' => 'Send to parent every added item:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Form.SendMonthly',
				'value' => 'Možnost posílat měsíční výpis:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Form.SendMonthly',
				'value' => 'Ability to send monthly expense:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Settings.Heading',
				'value' => 'nastavení',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Settings.Heading',
				'value' => 'settings',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ShowItems.CheckAll.Alert',
				'value' => 'Chcete přesunout do archivu všechny tyto položky?',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ShowItems.CheckAll.Alert',
				'value' => 'Do you really want to archive all displayed items?',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ShowItems.CheckAll.Title',
				'value' => 'Přesunout do archivu všechny zobrazené',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ShowItems.CheckAll.Title',
				'value' => 'Archive all pisplayed items',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'ShowItems.Delete.Alert',
				'value' => 'Opravdu chceš smazat?',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'ShowItems.Delete.Alert',
				'value' => 'Do you really want to delete this item?',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.Description',
				'value' => 'Zde se můžete podívat na statistiku, jak na tom tento měsíc jste vzhledem k předešlým měsícům. Vybrat si můžete, jestli chcete přehled konkrétního druhu útraty, či všeho.',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.Description',
				'value' => 'Here you can look at the statistics as of the month you are due to the previous months. Choose if you want to review a specific note or everything.',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.Filtering.NotesLabel',
				'value' => 'Statistika pro určitý druh útraty:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.Filtering.NotesLabel',
				'value' => 'Statistics for specific note:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.Filtering.Types.Default',
				'value' => '--druh útraty--',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.Filtering.Types.Default',
				'value' => '--note--',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Average',
				'value' => 'PRŮMĚRNĚ:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Average',
				'value' => 'AVERAGE:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Date',
				'value' => 'Měsíc',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Date',
				'value' => 'Month',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Max',
				'value' => 'MAX:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Max',
				'value' => 'MAX:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Min',
				'value' => 'MIN:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Min',
				'value' => 'MIN:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Percentage',
				'value' => 'Procento:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Percentage',
				'value' => 'Percentage',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.ThisMonth',
				'value' => 'Tento měsíc',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.ThisMonth',
				'value' => 'This month',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Value',
				'value' => 'Útrata',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.Extremes.Value',
				'value' => 'Expense',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.H2',
				'value' => 'Srovnání s celými měsíci',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.FullMonth.H2',
				'value' => 'Comparsion with whole months',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.H1',
				'value' => 'Měsíční přehled peněženky:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.H1',
				'value' => 'Monthly preview of wallet:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Average',
				'value' => 'PRŮMĚR:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Average',
				'value' => 'AVERAGE:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Date',
				'value' => 'Měsíc',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Date',
				'value' => 'Month',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Max',
				'value' => 'MAX:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Max',
				'value' => 'MAX:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Min',
				'value' => 'MIN:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Min',
				'value' => 'MIN:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Percentage',
				'value' => 'Procento',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Percentage',
				'value' => 'Percentage',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.ThisMonth',
				'value' => 'Tento měsíc',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.ThisMonth',
				'value' => 'This month',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Value',
				'value' => 'Útrata',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.Extremes.Value',
				'value' => 'Expense',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.H2',
				'value' => 'Srovnání s měsíci do {%d}. každého měsíce',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.PartMonth.H2',
				'value' => 'Comparsion with months since {%d}th of each month',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.TableFull.Head.Expense',
				'value' => 'Útrata',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.TableFull.Head.Expense',
				'value' => 'Expense',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Statistics.TableFull.Head.ExpensesCnt',
				'value' => 'položek',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Statistics.TableFull.Head.ExpensesCnt',
				'value' => '#expenses',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.Income',
				'value' => 'Příjem',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.Income',
				'value' => 'Income',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.IncomesCnt',
				'value' => 'položek',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.IncomesCnt',
				'value' => '#incomes',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.Percentage',
				'value' => 'Procento',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.Percentage',
				'value' => 'Percentage',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.Season',
				'value' => 'Měsíc',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.Season',
				'value' => 'Month',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.ThisMonth',
				'value' => 'Útrata tohoto měsíce',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TableFull.Head.ThisMonth',
				'value' => 'Expense of this month',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.Expense',
				'value' => 'Útrata',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.Expense',
				'value' => 'Monthly expense',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.ExpensesCnt',
				'value' => 'položek',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.ExpensesCnt',
				'value' => '#expenses',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.Income',
				'value' => 'Příjem',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.Income',
				'value' => 'Monthly income',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.IncomesCnt',
				'value' => 'položek',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.IncomesCnt',
				'value' => '#incomes',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.Percentage',
				'value' => 'Procento',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.Percentage',
				'value' => 'Percentage',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.Season',
				'value' => 'Měsíc',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.Season',
				'value' => 'Month',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.ThisMonth',
				'value' => 'Útrata tohoto měsíce',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Statistics.TablePart.Head.ThisMonth',
				'value' => 'Expense of this month',
				'LanguageCode' => 'ENG',
			],
			[
			'TranslationCode' => 'Status.Card',
				'value' => 'Zůstatek na kartě',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Status.Cash',
				'value' => 'Zůstatek v hotovosti',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Title',
				'value' => ' - útrata',
				'LanguageCode' => 'CZK',
			],
			[
			'TranslationCode' => 'Title',
				'value' => '\'s expense',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Course.Empty',
				'value' => 'Nevyplněný kurz',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Course.Empty',
				'value' => 'Empty course',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Date.Empty',
				'value' => 'Nevyplněný datum',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Date.Empty',
				'value' => 'Empty date',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Name.Empty',
				'value' => 'Nevyplněný název',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Name.Empty',
				'value' => 'Empty name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Price.BadFormat',
				'value' => 'Cena ve špatném formátu',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Price.BadFormat',
				'value' => 'Price in bad format',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Price.Empty',
				'value' => 'Nevyplněná cena',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Error.Price.Empty',
				'value' => 'Empty price',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.AnotherCurrency',
				'value' => 'jiná měna',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.AnotherCurrency',
				'value' => 'other currency',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Currency',
				'value' => 'Měna:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Currency',
				'value' => 'Currency:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.CurrencyCourse',
				'value' => 'kurz:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.CurrencyCourse',
				'value' => 'course:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Date',
				'value' => 'Datum:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Date',
				'value' => 'Date:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Heading',
				'value' => 'Upravit příjem',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Heading',
				'value' => 'Change income',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Name',
				'value' => 'Krátký popis:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Name',
				'value' => 'Short description:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Price',
				'value' => 'Cena:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Price',
				'value' => 'Price:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Save',
				'value' => 'Vytvořit',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Save',
				'value' => 'Store',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Type',
				'value' => 'Typ:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Type',
				'value' => 'Type:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Type.Card',
				'value' => 'Na kartu',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Type.Card',
				'value' => 'To card',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Type.Cash',
				'value' => 'V hotovosti',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Type.Cash',
				'value' => 'In cash',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Wallet',
				'value' => 'Peněženka:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateIncome.Form.Wallet',
				'value' => 'Wallet:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.AlreadyUpdating',
				'value' => 'Již se aktualizuje položka',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.AlreadyUpdating',
				'value' => 'Update already in progress',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Course.Empty',
				'value' => 'Nevyplněný kurz',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Course.Empty',
				'value' => 'Empty course',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Date.Empty',
				'value' => 'Nevyplněné datum',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Date.Empty',
				'value' => 'Empty date',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Name.Empty',
				'value' => 'Nevyplněné jméno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Name.Empty',
				'value' => 'Empty name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Price.BadFormat',
				'value' => 'Špatná cena',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Price.BadFormat',
				'value' => 'Wrong price',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Price.Empty',
				'value' => 'Nevyplněná cena',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Error.Price.Empty',
				'value' => 'Empty price',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.AnotherCurrency',
				'value' => 'jiná měna',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.AnotherCurrency',
				'value' => 'other currency',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Course',
				'value' => 'kurz:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Course',
				'value' => 'course:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Currency',
				'value' => 'Měna:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Currency',
				'value' => 'Currency:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Date',
				'value' => 'Datum:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Date',
				'value' => 'Date:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Description',
				'value' => 'Popis:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Description',
				'value' => 'Description:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Heading',
				'value' => 'Úprava položky',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Heading',
				'value' => 'Update item form',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Name',
				'value' => 'Název:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Name',
				'value' => 'Name:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Odepsat',
				'value' => 'Odepsat:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Odepsat',
				'value' => 'My expense:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Price',
				'value' => 'Cena:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Price',
				'value' => 'Price:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Purpose',
				'value' => 'Druh útraty:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Purpose',
				'value' => 'Note:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Save',
				'value' => 'Upravit',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Save',
				'value' => 'Update',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Type',
				'value' => 'Typ:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Type',
				'value' => 'Type:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Type.Card',
				'value' => 'Karta',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Type.Card',
				'value' => 'Card',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Type.Cash',
				'value' => 'Hotovost',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Type.Cash',
				'value' => 'Cash',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Wallet',
				'value' => 'Peněženka:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Form.Wallet',
				'value' => 'Wallet:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Storno',
				'value' => 'Storno',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'UpdateItem.Update',
				'value' => 'Uložit',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'UpdateItem.Update',
				'value' => 'Save',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uploading.Error.Again',
				'value' => 'Chyba při načítání souboru. Zkuste to prosím později',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uploading.Error.Again',
				'value' => 'Error durning uploading file. Please try it again',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uploading.Error.NoCSV',
				'value' => 'Soubor není typu CSV',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uploading.Error.NoCSV',
				'value' => 'The file is not of CSV type',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uploading.Error.NoFile',
				'value' => 'Vyberte nějaký soubor',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uploading.Error.NoFile',
				'value' => 'Must choose some file',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uploading.Success',
				'value' => 'Soubor nahrán',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uploading.Success',
				'value' => 'File uploaded',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uploading.Upload.Button',
				'value' => 'Vybrat soubor',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uploading.Upload.Button',
				'value' => 'Choose file',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.DownloadBackUp.ErrorOcured',
				'value' => 'Vyskytla se chyba',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.DownloadBackUp.ErrorOcured',
				'value' => 'Error ocures',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.AndMonth',
				'value' => 'a vybrat pouze',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.AndMonth',
				'value' => 'and select only',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.HelpTitle',
				'value' => 'jednotlivé řetězce oddělujte dvěma mezerama, pro napsání dvou mezer napiště \'\\ \\ \'.&#010;\'!\' před řetězcem - řetězec, který se v položce nikde nevyskytuje. Pro napsání vykřičníku použijte výraz \'\\!\'',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.HelpTitle',
				'value' => 'Every string delimite by two spaces, for typing two spaces type \'\\ \\ \'.&#010;\'!\' before string - string which is nowhere in every item for typing exclamation mark use expresion \'\\!\'',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Month.Default',
				'value' => '--měsíc--',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Month.Default',
				'value' => '--month--',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Or',
				'value' => 'nebo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Or',
				'value' => 'or',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy',
				'value' => 'Řadit podle',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy',
				'value' => 'Order by',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.Asc',
				'value' => 'Vzestupně',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.Asc',
				'value' => 'Ascendant',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.Desc',
				'value' => 'Sestupně',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.Desc',
				'value' => 'Descendant',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemDate',
				'value' => 'Datum',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemDate',
				'value' => 'Date',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemName',
				'value' => 'Název',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemName',
				'value' => 'Name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemPrice',
				'value' => 'Cena',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemPrice',
				'value' => 'Price',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Pattern',
				'value' => 'slovo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Pattern',
				'value' => 'pattern',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.SetDefaultTitle',
				'value' => 'výchozí filtrování',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.SetDefaultTitle',
				'value' => 'default filtering',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Types.Default',
				'value' => '- druh útraty -',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Types.Default',
				'value' => '- note -',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Year',
				'value' => 'rok',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Filtering.Year',
				'value' => 'year',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Uvod.Heading1',
				'value' => 'útrata :-)',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Uvod.Heading1',
				'value' => 'charges :-)',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.Add.CreateBtn',
				'value' => 'Vytvořit',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.Add.CreateBtn',
				'value' => 'Create',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.Add.Error.Empty',
				'value' => 'Nevyplněné jméno',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.Add.Error.Empty',
				'value' => 'Empty name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.Add.Name',
				'value' => 'Název:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.Add.Name',
				'value' => 'Name:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.Add.Name.Placeholder',
				'value' => 'název',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.Add.Name.Placeholder',
				'value' => 'name',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.Add.Title',
				'value' => 'Přidat novou peněženku',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.Add.Title',
				'value' => 'Add new Wallet',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.DeleteBtn.Title',
				'value' => 'Smazat peněženku',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.DeleteBtn.Title',
				'value' => 'Delete wallet',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.H2',
				'value' => 'Výdaje peněženky:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.H2',
				'value' => 'Expenses of wallet:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.H2.OldItems',
				'value' => 'Archivované výdaje peněženky:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.H2.OldItems',
				'value' => 'Archived expenses of wallet:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.Preview.Card',
				'value' => 'Na kartě:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.Preview.Card',
				'value' => 'On card:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.Preview.Cash',
				'value' => 'V hotovosti:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.Preview.Cash',
				'value' => 'In cash:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.Preview.Items',
				'value' => 'Položek:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.Preview.Items',
				'value' => 'Items:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.Preview.PerMonth',
				'value' => 'Tento měsíc:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.Preview.PerMonth',
				'value' => 'This month:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Wallet.UpdateBtn.Title',
				'value' => 'Modifikovat peněženku',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Wallet.UpdateBtn.Title',
				'value' => 'Update wallet',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Yes',
				'value' => 'ANO',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Yes',
				'value' => 'YES',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.H1',
				'value' => 'Registrace',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.H1',
				'value' => 'Sign in',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Login.Placeholder',
				'value' => 'login',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Login.Placeholder',
				'value' => 'login',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Password',
				'value' => 'Heslo:',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Password',
				'value' => 'Password:',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Login.Empty',
				'value' => 'Nevyplněný login',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Login.Empty',
				'value' => 'Empty login',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Login.Short',
				'value' => 'Příliš krátký login (< {%d} znaků)',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Login.Short',
				'value' => 'Login too short (< {%d} chars)',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Login.Exists',
				'value' => 'Tento login již existuje',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Login.Exists',
				'value' => 'This login already exists',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Password.Empty',
				'value' => 'Nevyplněné heslo',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Password.Empty',
				'value' => 'Empty password',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Password.Short',
				'value' => 'Heslo příliš krátké (< {%d} znaků)',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Password.Short',
				'value' => 'Password too short (< {%d} chars)',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Password.NotSame',
				'value' => 'Hesla nejsou stejné',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Password.NotSame',
				'value' => 'Passwords are not same',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Email.Empty',
				'value' => 'Nevyplněný e-mail',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Email.Empty',
				'value' => 'Empty e-mail',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Email.BadFormat',
				'value' => 'E-mail ve špatném formátu',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Form.Email.BadFormat',
				'value' => 'E-mail in bad format',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Form.Emil.Exists',
				'value' => 'Tento e-mail již existuje',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Form.Emil.Exists',
				'value' => 'This e-mail already exists',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Register.Button',
				'value' => 'Registrovat',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Register.Button',
				'value' => 'Sign in',
				'LanguageCode' => 'ENG',
			],
			[
				'TranslationCode' => 'Login.Register.Button',
				'value' => 'Registrovat',
				'LanguageCode' => 'CZK',
			],
			[
				'TranslationCode' => 'Login.Register.Button',
				'value' => 'Sign in',
				'LanguageCode' => 'ENG',
			],
		];
	}
}
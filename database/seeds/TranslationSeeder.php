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
    public function run()
    {
        $this->prepareData();
        DB::table('utrata_translations')->insert($this->data);
    }

    private $data = [];

    private function prepareData() {
        $this->data = [
            [
                'TranslationCode' => 'Add',
                'LanguageCode' => 'CZK',
                'value' => 'Jiná měna',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Course.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty course',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Course.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný kurz',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Date.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty date',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Date.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný datum',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Name.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty name',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Name.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný název',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Price.BadFormat',
                'LanguageCode' => 'ENG',
                'value' => 'Price in bad format',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Price.BadFormat',
                'LanguageCode' => 'CZK',
                'value' => 'Cena ve špatném formátu',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Price.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty price',
            ],
            [
                'TranslationCode' => 'AddIncome.Error.Price.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněná cena',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.AnotherCurrency',
                'LanguageCode' => 'ENG',
                'value' => 'other currency',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.AnotherCurrency',
                'LanguageCode' => 'CZK',
                'value' => 'jiná měna',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Currency',
                'LanguageCode' => 'ENG',
                'value' => 'Currency:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Currency',
                'LanguageCode' => 'CZK',
                'value' => 'Měna:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.CurrencyCourse',
                'LanguageCode' => 'ENG',
                'value' => 'course:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.CurrencyCourse',
                'LanguageCode' => 'CZK',
                'value' => 'kurz:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Date',
                'LanguageCode' => 'ENG',
                'value' => 'Date:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Date',
                'LanguageCode' => 'CZK',
                'value' => 'Datum:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Heading',
                'LanguageCode' => 'ENG',
                'value' => 'Create new income',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Heading',
                'LanguageCode' => 'CZK',
                'value' => 'Nový příjem',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Name',
                'LanguageCode' => 'ENG',
                'value' => 'Short description:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Name',
                'LanguageCode' => 'CZK',
                'value' => 'Krátký popis:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Name.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'salary',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Name.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'výplata',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Price',
                'LanguageCode' => 'ENG',
                'value' => 'Price:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Price',
                'LanguageCode' => 'CZK',
                'value' => 'Cena:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Save',
                'LanguageCode' => 'ENG',
                'value' => 'Store',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Save',
                'LanguageCode' => 'CZK',
                'value' => 'Vytvořit',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Storno',
                'LanguageCode' => 'ENG',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Storno',
                'LanguageCode' => 'CZK',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Type',
                'LanguageCode' => 'ENG',
                'value' => 'Type:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Type',
                'LanguageCode' => 'CZK',
                'value' => 'Typ:',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Type.Card',
                'LanguageCode' => 'ENG',
                'value' => 'To card',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Type.Card',
                'LanguageCode' => 'CZK',
                'value' => 'Na kartu',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Type.Cash',
                'LanguageCode' => 'ENG',
                'value' => 'In cash',
            ],
            [
                'TranslationCode' => 'AddIncome.Form.Type.Cash',
                'LanguageCode' => 'CZK',
                'value' => 'V hotovosti',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Course.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty course',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Course.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný kurz',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Date.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty date',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Date.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný datum',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Name.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty name',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Name.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněné jméno',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Note.NoNote',
                'LanguageCode' => 'ENG',
                'value' => 'No note selected. Take some notes in settings.',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Note.NoNote',
                'LanguageCode' => 'CZK',
                'value' => 'Nevybrán druh útraty. Nějaký si vyberte v nastavení.',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Price.BadFormat',
                'LanguageCode' => 'ENG',
                'value' => 'Wrong price',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Price.BadFormat',
                'LanguageCode' => 'CZK',
                'value' => 'Špatná cena',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Price.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty price',
            ],
            [
                'TranslationCode' => 'AddItem.Error.Price.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněná cena',
            ],
            [
                'TranslationCode' => 'AddItem.Form.AnotherCurrency',
                'LanguageCode' => 'ENG',
                'value' => 'other currency',
            ],
            [
                'TranslationCode' => 'AddItem.Form.AnotherCurrency',
                'LanguageCode' => 'CZK',
                'value' => 'jiná měna',
            ],
            [
                'TranslationCode' => 'AddItem.Form.BadName',
                'LanguageCode' => 'ENG',
                'value' => 'Fill name',
            ],
            [
                'TranslationCode' => 'AddItem.Form.BadName',
                'LanguageCode' => 'CZK',
                'value' => 'Vyplň název',
            ],
            [
                'TranslationCode' => 'AddItem.Form.BadPrice',
                'LanguageCode' => 'ENG',
                'value' => 'Fill price',
            ],
            [
                'TranslationCode' => 'AddItem.Form.BadPrice',
                'LanguageCode' => 'CZK',
                'value' => 'Vyplň cenu',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Currency',
                'LanguageCode' => 'ENG',
                'value' => 'Currency:',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Currency',
                'LanguageCode' => 'CZK',
                'value' => 'Měna:',
            ],
            [
                'TranslationCode' => 'AddItem.Form.CurrencyCourse',
                'LanguageCode' => 'ENG',
                'value' => 'course',
            ],
            [
                'TranslationCode' => 'AddItem.Form.CurrencyCourse',
                'LanguageCode' => 'CZK',
                'value' => 'kurz',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Date',
                'LanguageCode' => 'ENG',
                'value' => 'Date',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Date',
                'LanguageCode' => 'CZK',
                'value' => 'Datum',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Description',
                'LanguageCode' => 'ENG',
                'value' => 'Description',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Description',
                'LanguageCode' => 'CZK',
                'value' => 'Popis',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Description.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'description',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Description.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'popis',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Duplicity',
                'LanguageCode' => 'ENG',
                'value' => 'Item already exists',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Duplicity',
                'LanguageCode' => 'CZK',
                'value' => 'Záznam již existuje',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Heading',
                'LanguageCode' => 'ENG',
                'value' => 'Add new item',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Heading',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat novou položku',
            ],
            [
                'TranslationCode' => 'AddItem.Form.MyExpense',
                'LanguageCode' => 'ENG',
                'value' => 'WRITE OFF',
            ],
            [
                'TranslationCode' => 'AddItem.Form.MyExpense',
                'LanguageCode' => 'CZK',
                'value' => 'ODEPSAT',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Name',
                'LanguageCode' => 'ENG',
                'value' => 'Name',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Name',
                'LanguageCode' => 'CZK',
                'value' => 'Název',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Name.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'name',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Name.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'název',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Note',
                'LanguageCode' => 'ENG',
                'value' => 'Note',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Note',
                'LanguageCode' => 'CZK',
                'value' => 'Druh útraty',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Pick',
                'LanguageCode' => 'ENG',
                'value' => 'ATM PICK',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Pick',
                'LanguageCode' => 'CZK',
                'value' => 'VÝBĚR Z BANKOMATU',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Price',
                'LanguageCode' => 'ENG',
                'value' => 'Price',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Price',
                'LanguageCode' => 'CZK',
                'value' => 'Cena',
            ],
            [
                'TranslationCode' => 'AddItem.Form.RequiredField',
                'LanguageCode' => 'ENG',
                'value' => 'Required field',
            ],
            [
                'TranslationCode' => 'AddItem.Form.RequiredField',
                'LanguageCode' => 'CZK',
                'value' => 'Povinné pole',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Save',
                'LanguageCode' => 'ENG',
                'value' => 'Store',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Save',
                'LanguageCode' => 'CZK',
                'value' => 'Nahrát',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Storno',
                'LanguageCode' => 'ENG',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Storno',
                'LanguageCode' => 'CZK',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Success',
                'LanguageCode' => 'ENG',
                'value' => 'Item was stored into database',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Success',
                'LanguageCode' => 'CZK',
                'value' => 'Položka byla nahrána do databáze',
            ],
            [
                'TranslationCode' => 'AddItem.Form.SuccessButton',
                'LanguageCode' => 'ENG',
                'value' => 'Add another item',
            ],
            [
                'TranslationCode' => 'AddItem.Form.SuccessButton',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat další položku',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Type',
                'LanguageCode' => 'ENG',
                'value' => 'Payment type',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Type',
                'LanguageCode' => 'CZK',
                'value' => 'Typ platby',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Type.Card',
                'LanguageCode' => 'ENG',
                'value' => 'Card',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Type.Card',
                'LanguageCode' => 'CZK',
                'value' => 'Karta',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Type.Cash',
                'LanguageCode' => 'ENG',
                'value' => 'Cash',
            ],
            [
                'TranslationCode' => 'AddItem.Form.Type.Cash',
                'LanguageCode' => 'CZK',
                'value' => 'Hotovost',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.AddAnotherItem',
                'LanguageCode' => 'ENG',
                'value' => 'Add another item',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.AddAnotherItem',
                'LanguageCode' => 'CZK',
                'value' => 'Přidal talší položku',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.AddedText',
                'LanguageCode' => 'ENG',
                'value' => 'Transaction completed',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.AddedText',
                'LanguageCode' => 'CZK',
                'value' => 'Transakce proběhla úspěně',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.BadPrice',
                'LanguageCode' => 'ENG',
                'value' => 'Fill price',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.BadPrice',
                'LanguageCode' => 'CZK',
                'value' => 'Vyplň cenu',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.BadReason',
                'LanguageCode' => 'ENG',
                'value' => 'Fill reason',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.BadReason',
                'LanguageCode' => 'CZK',
                'value' => 'Vyplň důvod',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Price',
                'LanguageCode' => 'ENG',
                'value' => 'Give',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Price',
                'LanguageCode' => 'CZK',
                'value' => 'Věnovat',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.PriceNaN',
                'LanguageCode' => 'ENG',
                'value' => 'Price is not a number',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.PriceNaN',
                'LanguageCode' => 'CZK',
                'value' => 'Cena není číslo',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Reason',
                'LanguageCode' => 'ENG',
                'value' => 'Reason',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Reason',
                'LanguageCode' => 'CZK',
                'value' => 'Důvod',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Reason.Default',
                'LanguageCode' => 'ENG',
                'value' => 'Max 60 chars',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Reason.Default',
                'LanguageCode' => 'CZK',
                'value' => 'Max 60 zanků',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.ReasonBadLength',
                'LanguageCode' => 'ENG',
                'value' => 'Reason can have at least {%d} letters',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.ReasonBadLength',
                'LanguageCode' => 'CZK',
                'value' => 'Důvod může mít nejvýe {%d} znaků',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Send',
                'LanguageCode' => 'ENG',
                'value' => 'Add',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Send',
                'LanguageCode' => 'CZK',
                'value' => 'Nahrát',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Type',
                'LanguageCode' => 'ENG',
                'value' => 'On',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Type',
                'LanguageCode' => 'CZK',
                'value' => 'Na',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Type.Card',
                'LanguageCode' => 'ENG',
                'value' => 'Card',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Type.Card',
                'LanguageCode' => 'CZK',
                'value' => 'Kartu',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Type.Cash',
                'LanguageCode' => 'ENG',
                'value' => 'Cash',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.Type.Cash',
                'LanguageCode' => 'CZK',
                'value' => 'V hotovosti',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.UseDelimiter',
                'LanguageCode' => 'ENG',
                'value' => 'Use decimal point instead of comma',
            ],
            [
                'TranslationCode' => 'AddTransaction.Form.UseDelimiter',
                'LanguageCode' => 'CZK',
                'value' => 'Pro oddělení haléřů použij desetinnou tečku',
            ],
            [
                'TranslationCode' => 'AddTransaction.Heading1',
                'LanguageCode' => 'ENG',
                'value' => 'Add amount',
            ],
            [
                'TranslationCode' => 'AddTransaction.Heading1',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat částku',
            ],
            [
                'TranslationCode' => 'AddTransaction.SuccessMail.Message1',
                'LanguageCode' => 'ENG',
                'value' => 'Was credited',
            ],
            [
                'TranslationCode' => 'AddTransaction.SuccessMail.Message1',
                'LanguageCode' => 'CZK',
                'value' => 'Bylo připsáno',
            ],
            [
                'TranslationCode' => 'AddTransaction.SuccessMail.Message2',
                'LanguageCode' => 'ENG',
                'value' => 'Purpose',
            ],
            [
                'TranslationCode' => 'AddTransaction.SuccessMail.Message2',
                'LanguageCode' => 'CZK',
                'value' => 'Věc',
            ],
            [
                'TranslationCode' => 'AddTransaction.SuccessMail.Subject',
                'LanguageCode' => 'ENG',
                'value' => 'Transaction on',
            ],
            [
                'TranslationCode' => 'AddTransaction.SuccessMail.Subject',
                'LanguageCode' => 'CZK',
                'value' => 'Transakce na',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Date',
                'LanguageCode' => 'ENG',
                'value' => 'Date',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Date',
                'LanguageCode' => 'CZK',
                'value' => 'Datum',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Delete',
                'LanguageCode' => 'ENG',
                'value' => 'Delete',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Delete',
                'LanguageCode' => 'CZK',
                'value' => 'Smazat',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Delete.Title',
                'LanguageCode' => 'ENG',
                'value' => 'Delete',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Delete.Title',
                'LanguageCode' => 'CZK',
                'value' => 'Smazat',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.ID',
                'LanguageCode' => 'ENG',
                'value' => 'ID',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.ID',
                'LanguageCode' => 'CZK',
                'value' => 'ID',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Reason',
                'LanguageCode' => 'ENG',
                'value' => 'Reason',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Reason',
                'LanguageCode' => 'CZK',
                'value' => 'Důvod',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Type',
                'LanguageCode' => 'ENG',
                'value' => 'Type',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Type',
                'LanguageCode' => 'CZK',
                'value' => 'Typ',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Value',
                'LanguageCode' => 'ENG',
                'value' => 'Amount',
            ],
            [
                'TranslationCode' => 'AddTransaction.Table.Value',
                'LanguageCode' => 'CZK',
                'value' => 'Hodnota',
            ],
            [
                'TranslationCode' => 'Dashboard.AddWallet',
                'LanguageCode' => 'ENG',
                'value' => 'Add wallet',
            ],
            [
                'TranslationCode' => 'Dashboard.AddWallet',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat peněženku',
            ],
            [
                'TranslationCode' => 'Dashboard.Heading',
                'LanguageCode' => 'ENG',
                'value' => 'List of wallets',
            ],
            [
                'TranslationCode' => 'Dashboard.Heading',
                'LanguageCode' => 'CZK',
                'value' => 'Seznam peněženek',
            ],
            [
                'TranslationCode' => 'Error.LoginAgain',
                'LanguageCode' => 'ENG',
                'value' => 'Log in again',
            ],
            [
                'TranslationCode' => 'Error.LoginAgain',
                'LanguageCode' => 'CZK',
                'value' => 'Přihlašte se znova',
            ],
            [
                'TranslationCode' => 'Error.LogInFirst',
                'LanguageCode' => 'ENG',
                'value' => 'You have to login first',
            ],
            [
                'TranslationCode' => 'Error.LogInFirst',
                'LanguageCode' => 'CZK',
                'value' => 'Nejdřív se přihlašte',
            ],
            [
                'TranslationCode' => 'Exception.AlreadyExists',
                'LanguageCode' => 'ENG',
                'value' => ':entity with this :parameter already exists',
            ],
            [
                'TranslationCode' => 'Exception.AlreadyExists',
                'LanguageCode' => 'CZK',
                'value' => ':entity s tímto :parameter již existuje',
            ],
            [
                'TranslationCode' => 'Exception.BadParameter.SmallerThan1',
                'LanguageCode' => 'ENG',
                'value' => 'Identifier smaller than 1',
            ],
            [
                'TranslationCode' => 'Exception.BadParameter.SmallerThan1',
                'LanguageCode' => 'CZK',
                'value' => 'Identifikátor menší než 1',
            ],
            [
                'TranslationCode' => 'Exception.CannotRemove',
                'LanguageCode' => 'ENG',
                'value' => 'Cannot remove this :entity',
            ],
            [
                'TranslationCode' => 'Exception.CannotRemove',
                'LanguageCode' => 'CZK',
                'value' => 'Nelze odstranit tento :entity',
            ],
            [
                'TranslationCode' => 'Exception.ColumnNotAllowed',
                'LanguageCode' => 'ENG',
                'value' => 'This column (:column) not allowed.',
            ],
            [
                'TranslationCode' => 'Exception.ColumnNotAllowed',
                'LanguageCode' => 'CZK',
                'value' => 'Tento sloupec (:column) není dovoleno nastavit',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.BadParameter.SmallerThan1',
                'LanguageCode' => 'ENG',
                'value' => 'Parse:entity: Identifier smaller than 1',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.BadParameter.SmallerThan1',
                'LanguageCode' => 'CZK',
                'value' => 'Parse:entity: Identifikátor menší než 1',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.CountExpected',
                'LanguageCode' => 'ENG',
                'value' => 'Parse: :entity count expected: :expected, got :got',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.CountExpected',
                'LanguageCode' => 'CZK',
                'value' => 'Parse: :entity počet předpokládán: :expected, skutečně :got',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.NotInteger',
                'LanguageCode' => 'ENG',
                'value' => 'Parse: :entity count number not integer',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.NotInteger',
                'LanguageCode' => 'CZK',
                'value' => 'Parse: :entity počet není číslo',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.NthEntity',
                'LanguageCode' => 'ENG',
                'value' => ':numnt :entity: :message',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.NthEntity',
                'LanguageCode' => 'CZK',
                'value' => ':entity č. :num: :message',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.NthParameter',
                'LanguageCode' => 'ENG',
                'value' => ':numnt :entity: :message',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.NthParameter',
                'LanguageCode' => 'CZK',
                'value' => 'Pole :num :entity: :message',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.Parameter.Bad',
                'LanguageCode' => 'ENG',
                'value' => 'Parse:entity: bad :parameter',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.Parameter.Bad',
                'LanguageCode' => 'CZK',
                'value' => 'Parse:entity: špatný :parameter',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.Parameter.Missing',
                'LanguageCode' => 'ENG',
                'value' => 'Parse:entity: :parameter not found',
            ],
            [
                'TranslationCode' => 'Exception.FileParse.Parameter.Missing',
                'LanguageCode' => 'CZK',
                'value' => 'Parse:entity: :parameter nenalezen',
            ],
            [
                'TranslationCode' => 'Exception.Integrity',
                'LanguageCode' => 'ENG',
                'value' => 'Cannot remove cause of FK',
            ],
            [
                'TranslationCode' => 'Exception.Integrity',
                'LanguageCode' => 'CZK',
                'value' => 'Nelze odstranit kvůli FK',
            ],
            [
                'TranslationCode' => 'Exception.NotFound',
                'LanguageCode' => 'ENG',
                'value' => 'No :entity found',
            ],
            [
                'TranslationCode' => 'Exception.NotFound',
                'LanguageCode' => 'CZK',
                'value' => 'Žádný :entity nenalezen',
            ],
            [
                'TranslationCode' => 'Exception.NotFoundByParameter',
                'LanguageCode' => 'ENG',
                'value' => 'No :entity with given :parameter',
            ],
            [
                'TranslationCode' => 'Exception.NotFoundByParameter',
                'LanguageCode' => 'CZK',
                'value' => 'Žádn :entity se zadaným :parameter',
            ],
            [
                'TranslationCode' => 'Exception.Parameter.BadFormat',
                'LanguageCode' => 'ENG',
                'value' => ':parameter in bad format',
            ],
            [
                'TranslationCode' => 'Exception.Parameter.BadFormat',
                'LanguageCode' => 'CZK',
                'value' => ':parameter ve špatném formátu',
            ],
            [
                'TranslationCode' => 'Exception.Parameter.Incorrect',
                'LanguageCode' => 'ENG',
                'value' => 'Given :parameter is incorrect',
            ],
            [
                'TranslationCode' => 'Exception.Parameter.Incorrect',
                'LanguageCode' => 'CZK',
                'value' => 'Zadaný :parameter je nesprávný',
            ],
            [
                'TranslationCode' => 'Exception.Parameter.Missing',
                'LanguageCode' => 'ENG',
                'value' => ':parameter is missing',
            ],
            [
                'TranslationCode' => 'Exception.Parameter.Missing',
                'LanguageCode' => 'CZK',
                'value' => 'Chybí pole :parameter',
            ],
            [
                'TranslationCode' => 'Exception.Security.BadPassword',
                'LanguageCode' => 'ENG',
                'value' => 'Bad password',
            ],
            [
                'TranslationCode' => 'Exception.Security.BadPassword',
                'LanguageCode' => 'CZK',
                'value' => 'Špatné heslo',
            ],
            [
                'TranslationCode' => 'Exception.UserNotOwner',
                'LanguageCode' => 'ENG',
                'value' => 'User is not owner of this :entity',
            ],
            [
                'TranslationCode' => 'Exception.UserNotOwner',
                'LanguageCode' => 'CZK',
                'value' => 'Nejste vlastníkem této :entity',
            ],
            [
                'TranslationCode' => 'Facebook.Error.AllowEmail',
                'LanguageCode' => 'ENG',
                'value' => 'You must allow your email in facebook',
            ],
            [
                'TranslationCode' => 'Facebook.Error.AllowEmail',
                'LanguageCode' => 'CZK',
                'value' => 'Musíte si na Facebooku povolit přístup k emailu',
            ],
            [
                'TranslationCode' => 'Facebook.Error.AllowLocale',
                'LanguageCode' => 'ENG',
                'value' => 'You must allow your locale on Facebook',
            ],
            [
                'TranslationCode' => 'Facebook.Error.AllowLocale',
                'LanguageCode' => 'CZK',
                'value' => 'Musíte si na Facebooku povolit své údaje o poloze a státu',
            ],
            [
                'TranslationCode' => 'Facebook.Error.AllowName',
                'LanguageCode' => 'ENG',
                'value' => 'You must allou your name in facebook',
            ],
            [
                'TranslationCode' => 'Facebook.Error.AllowName',
                'LanguageCode' => 'CZK',
                'value' => 'Musíte si nejprve povolit přístup ke jménu na facebooku',
            ],
            [
                'TranslationCode' => 'Form.Emil.Exists',
                'LanguageCode' => 'ENG',
                'value' => 'This e-mail already exists',
            ],
            [
                'TranslationCode' => 'Import.Description',
                'LanguageCode' => 'ENG',
                'value' => 'Load CSV file, which you previously download',
            ],
            [
                'TranslationCode' => 'Import.Description',
                'LanguageCode' => 'CZK',
                'value' => 'Vložte soubor CSV, který jste si dříve stáhl(a)',
            ],
            [
                'TranslationCode' => 'Import.Send',
                'LanguageCode' => 'ENG',
                'value' => 'Import',
            ],
            [
                'TranslationCode' => 'Import.Send',
                'LanguageCode' => 'CZK',
                'value' => 'Nahrát',
            ],
            [
                'TranslationCode' => 'Import.Title',
                'LanguageCode' => 'ENG',
                'value' => 'Import backup',
            ],
            [
                'TranslationCode' => 'Import.Title',
                'LanguageCode' => 'CZK',
                'value' => 'Nahrát zálohu',
            ],
            [
                'TranslationCode' => 'Income.Add.Title',
                'LanguageCode' => 'ENG',
                'value' => 'Add new income',
            ],
            [
                'TranslationCode' => 'Income.Add.Title',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat příjem',
            ],
            [
                'TranslationCode' => 'Incomes.H2',
                'LanguageCode' => 'ENG',
                'value' => 'Incomes of wallet:',
            ],
            [
                'TranslationCode' => 'Incomes.H2',
                'LanguageCode' => 'CZK',
                'value' => 'Příjmy peněženky:',
            ],
            [
                'TranslationCode' => 'Item.Add.Title',
                'LanguageCode' => 'ENG',
                'value' => 'Add new Item',
            ],
            [
                'TranslationCode' => 'Item.Add.Title',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat položku',
            ],
            [
                'TranslationCode' => 'Item.Form.Required',
                'LanguageCode' => 'ENG',
                'value' => 'Required fields',
            ],
            [
                'TranslationCode' => 'Item.Form.Required',
                'LanguageCode' => 'CZK',
                'value' => 'Povinné položky',
            ],
            [
                'TranslationCode' => 'Items.Loading.Alt',
                'LanguageCode' => 'ENG',
                'value' => 'Loading',
            ],
            [
                'TranslationCode' => 'Items.Loading.Alt',
                'LanguageCode' => 'CZK',
                'value' => 'Načítání',
            ],
            [
                'TranslationCode' => 'Login.Admin',
                'LanguageCode' => 'ENG',
                'value' => 'admin section',
            ],
            [
                'TranslationCode' => 'Login.Admin',
                'LanguageCode' => 'CZK',
                'value' => 'administrátor',
            ],
            [
                'TranslationCode' => 'Login.BadInput',
                'LanguageCode' => 'ENG',
                'value' => 'Wrong login',
            ],
            [
                'TranslationCode' => 'Login.BadInput',
                'LanguageCode' => 'CZK',
                'value' => 'Špatné přihlašovací údaje',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Mail.Message.Login',
                'LanguageCode' => 'ENG',
                'value' => 'Login',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Mail.Message.Login',
                'LanguageCode' => 'CZK',
                'value' => 'Login',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Mail.Message.Password',
                'LanguageCode' => 'ENG',
                'value' => 'password',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Mail.Message.Password',
                'LanguageCode' => 'CZK',
                'value' => 'heslo',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Mail.Subject.AppName',
                'LanguageCode' => 'ENG',
                'value' => 'Charge',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Mail.Subject.AppName',
                'LanguageCode' => 'CZK',
                'value' => 'Útrata',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Mail.Subject.Specification',
                'LanguageCode' => 'ENG',
                'value' => 'forgotten login',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Mail.Subject.Specification',
                'LanguageCode' => 'CZK',
                'value' => 'zapomenuté údaje',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Headding1',
                'LanguageCode' => 'ENG',
                'value' => 'Forgotten login',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Headding1',
                'LanguageCode' => 'CZK',
                'value' => 'Zapomenuté údaje',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Mail',
                'LanguageCode' => 'ENG',
                'value' => 'Your e-mail',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Mail',
                'LanguageCode' => 'CZK',
                'value' => 'Váš e-mail',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Send',
                'LanguageCode' => 'ENG',
                'value' => 'Send',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Send',
                'LanguageCode' => 'CZK',
                'value' => 'Odeslat',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.EmptyMail',
                'LanguageCode' => 'ENG',
                'value' => 'Fill mail',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.EmptyMail',
                'LanguageCode' => 'CZK',
                'value' => 'Vyplň mail',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.Error',
                'LanguageCode' => 'ENG',
                'value' => 'Something gone wrong',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.Error',
                'LanguageCode' => 'CZK',
                'value' => 'Něco se pokazilo',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.MailNotSent',
                'LanguageCode' => 'ENG',
                'value' => 'Can\'t send an e-mail',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.MailNotSent',
                'LanguageCode' => 'CZK',
                'value' => 'Email se nepodařilo odeslat',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.MorePeopleWithSameMail',
                'LanguageCode' => 'ENG',
                'value' => 'More people has the same e-mail address. Contact the web admin',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.MorePeopleWithSameMail',
                'LanguageCode' => 'CZK',
                'value' => 'Více lidí má stejný mail. Kontaktujte správce webu',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.Nobody',
                'LanguageCode' => 'ENG',
                'value' => 'Nobody with this e-mail address exists',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.Nobody',
                'LanguageCode' => 'CZK',
                'value' => 'Nikdo s takovým mailem není v databázi veden',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.SQLStatementError',
                'LanguageCode' => 'ENG',
                'value' => 'bad SQL statement',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.SQLStatementError',
                'LanguageCode' => 'CZK',
                'value' => 'španý SQL příkaz',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.Success',
                'LanguageCode' => 'ENG',
                'value' => 'Your login was sent to Your mail',
            ],
            [
                'TranslationCode' => 'Login.Forgotten.Modal.Status.Success',
                'LanguageCode' => 'CZK',
                'value' => 'Přihlašovací údaje Vám byly zaslány na',
            ],
            [
                'TranslationCode' => 'Login.ForgottenPassword',
                'LanguageCode' => 'ENG',
                'value' => 'Forgotten login',
            ],
            [
                'TranslationCode' => 'Login.ForgottenPassword',
                'LanguageCode' => 'CZK',
                'value' => 'Zapomenuté přihlašovací údaje',
            ],
            [
                'TranslationCode' => 'Login.Login',
                'LanguageCode' => 'ENG',
                'value' => 'Name',
            ],
            [
                'TranslationCode' => 'Login.Login',
                'LanguageCode' => 'CZK',
                'value' => 'Jméno',
            ],
            [
                'TranslationCode' => 'Login.LogInto',
                'LanguageCode' => 'ENG',
                'value' => 'Log in',
            ],
            [
                'TranslationCode' => 'Login.LogInto',
                'LanguageCode' => 'CZK',
                'value' => 'Přihlásit',
            ],
            [
                'TranslationCode' => 'Login.Password',
                'LanguageCode' => 'ENG',
                'value' => 'Password',
            ],
            [
                'TranslationCode' => 'Login.Password',
                'LanguageCode' => 'CZK',
                'value' => 'Heslo',
            ],
            [
                'TranslationCode' => 'Login.Register.Button',
                'LanguageCode' => 'ENG',
                'value' => 'Sign in',
            ],
            [
                'TranslationCode' => 'Login.Register.Button',
                'LanguageCode' => 'CZK',
                'value' => 'Registrovat',
            ],
            [
                'TranslationCode' => 'Login.SignIn',
                'LanguageCode' => 'ENG',
                'value' => 'Sign in',
            ],
            [
                'TranslationCode' => 'Login.SignIn',
                'LanguageCode' => 'CZK',
                'value' => 'Registrovat se',
            ],
            [
                'TranslationCode' => 'MailEngine.FailToSend',
                'LanguageCode' => 'ENG',
                'value' => 'Cannot send an e-mail',
            ],
            [
                'TranslationCode' => 'MailEngine.FailToSend',
                'LanguageCode' => 'CZK',
                'value' => 'E-mail se nepodařilo odeslat',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.AddButton',
                'LanguageCode' => 'ENG',
                'value' => 'add',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.AddButton',
                'LanguageCode' => 'CZK',
                'value' => 'přidat',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.AddLabel',
                'LanguageCode' => 'ENG',
                'value' => 'Add',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.AddLabel',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.Back',
                'LanguageCode' => 'ENG',
                'value' => 'Back',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.Back',
                'LanguageCode' => 'CZK',
                'value' => 'Zpět',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.DeleteNote',
                'LanguageCode' => 'ENG',
                'value' => 'Delete note',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.DeleteNote',
                'LanguageCode' => 'CZK',
                'value' => 'Smazat druh útraty',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.NoNote',
                'LanguageCode' => 'ENG',
                'value' => 'No one note',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.NoNote',
                'LanguageCode' => 'CZK',
                'value' => 'Žádný druh útraty',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.Table.Code',
                'LanguageCode' => 'ENG',
                'value' => 'Code',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.Table.Code',
                'LanguageCode' => 'CZK',
                'value' => 'Kód',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.Table.Name',
                'LanguageCode' => 'ENG',
                'value' => 'Name',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.Table.Name',
                'LanguageCode' => 'CZK',
                'value' => 'Název',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.Table.Using',
                'LanguageCode' => 'ENG',
                'value' => 'Using',
            ],
            [
                'TranslationCode' => 'ManageNotes.Form.Table.Using',
                'LanguageCode' => 'CZK',
                'value' => 'Používané',
            ],
            [
                'TranslationCode' => 'Member.Settings',
                'LanguageCode' => 'ENG',
                'value' => 'Settings',
            ],
            [
                'TranslationCode' => 'Member.Settings',
                'LanguageCode' => 'CZK',
                'value' => 'Nastavení',
            ],
            [
                'TranslationCode' => 'Menu.AddIncome',
                'LanguageCode' => 'ENG',
                'value' => 'Add income',
            ],
            [
                'TranslationCode' => 'Menu.AddIncome',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat příjem',
            ],
            [
                'TranslationCode' => 'Menu.AddItem',
                'LanguageCode' => 'ENG',
                'value' => 'Add item',
            ],
            [
                'TranslationCode' => 'Menu.AddItem',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat položku',
            ],
            [
                'TranslationCode' => 'Menu.Back',
                'LanguageCode' => 'ENG',
                'value' => 'Back',
            ],
            [
                'TranslationCode' => 'Menu.Back',
                'LanguageCode' => 'CZK',
                'value' => 'Zpět',
            ],
            [
                'TranslationCode' => 'Menu.DownloadBackUp',
                'LanguageCode' => 'ENG',
                'value' => 'Download backup',
            ],
            [
                'TranslationCode' => 'Menu.DownloadBackUp',
                'LanguageCode' => 'CZK',
                'value' => 'Stáhnout zálohu',
            ],
            [
                'TranslationCode' => 'Menu.Home',
                'LanguageCode' => 'ENG',
                'value' => 'Home',
            ],
            [
                'TranslationCode' => 'Menu.Home',
                'LanguageCode' => 'CZK',
                'value' => 'Domů',
            ],
            [
                'TranslationCode' => 'Menu.Incomes',
                'LanguageCode' => 'ENG',
                'value' => 'Incomes',
            ],
            [
                'TranslationCode' => 'Menu.Incomes',
                'LanguageCode' => 'CZK',
                'value' => 'Příjmy',
            ],
            [
                'TranslationCode' => 'Menu.LoadImport',
                'LanguageCode' => 'ENG',
                'value' => 'Load data',
            ],
            [
                'TranslationCode' => 'Menu.LoadImport',
                'LanguageCode' => 'CZK',
                'value' => 'Nahrát data',
            ],
            [
                'TranslationCode' => 'Menu.Logout',
                'LanguageCode' => 'ENG',
                'value' => 'Logout',
            ],
            [
                'TranslationCode' => 'Menu.Logout',
                'LanguageCode' => 'CZK',
                'value' => 'Odhlásit',
            ],
            [
                'TranslationCode' => 'Menu.MonthlyPreview',
                'LanguageCode' => 'ENG',
                'value' => 'Monthly preview',
            ],
            [
                'TranslationCode' => 'Menu.MonthlyPreview',
                'LanguageCode' => 'CZK',
                'value' => 'Měsíční přehled',
            ],
            [
                'TranslationCode' => 'Menu.OldItems',
                'LanguageCode' => 'ENG',
                'value' => 'Archive',
            ],
            [
                'TranslationCode' => 'Menu.OldItems',
                'LanguageCode' => 'CZK',
                'value' => 'Archiv',
            ],
            [
                'TranslationCode' => 'Menu.Settings',
                'LanguageCode' => 'ENG',
                'value' => 'Settings',
            ],
            [
                'TranslationCode' => 'Menu.Settings',
                'LanguageCode' => 'CZK',
                'value' => 'Nastavení',
            ],
            [
                'TranslationCode' => 'Menu.Shortcuts',
                'LanguageCode' => 'ENG',
                'value' => 'shortcuts',
            ],
            [
                'TranslationCode' => 'Menu.Shortcuts',
                'LanguageCode' => 'CZK',
                'value' => 'klávesové zkratky',
            ],
            [
                'TranslationCode' => 'Menu.ShortcutsTitle',
                'LanguageCode' => 'ENG',
                'value' => 'Ctrl+, - new item Ctrl+M - new transaction Ctrl+O - archive Ctrl+S - settings Ctrl+Z - back in history Ctrl+Y - front to history Ctrl+B - back Ctrl+L - lo',
            ],
            [
                'TranslationCode' => 'Menu.ShortcutsTitle',
                'LanguageCode' => 'CZK',
                'value' => 'Ctrl+, - nový záznam Ctrl+M - nová transakce Ctrl+O - archiv Ctrl+S - nastavení Ctrl+Z - zpět v historii Ctrl+Y - vpřed v historii Ctrl+B - zpět na hlavní',
            ],
            [
                'TranslationCode' => 'Menu.Wallet',
                'LanguageCode' => 'ENG',
                'value' => 'Wallet',
            ],
            [
                'TranslationCode' => 'Menu.Wallet',
                'LanguageCode' => 'CZK',
                'value' => 'Peněženka',
            ],
            [
                'TranslationCode' => 'Month.April',
                'LanguageCode' => 'ENG',
                'value' => 'April',
            ],
            [
                'TranslationCode' => 'Month.April',
                'LanguageCode' => 'CZK',
                'value' => 'Duben',
            ],
            [
                'TranslationCode' => 'Month.August',
                'LanguageCode' => 'ENG',
                'value' => 'August',
            ],
            [
                'TranslationCode' => 'Month.August',
                'LanguageCode' => 'CZK',
                'value' => 'Srpen',
            ],
            [
                'TranslationCode' => 'Month.December',
                'LanguageCode' => 'ENG',
                'value' => 'December',
            ],
            [
                'TranslationCode' => 'Month.December',
                'LanguageCode' => 'CZK',
                'value' => 'Prosinec',
            ],
            [
                'TranslationCode' => 'Month.February',
                'LanguageCode' => 'ENG',
                'value' => 'February',
            ],
            [
                'TranslationCode' => 'Month.February',
                'LanguageCode' => 'CZK',
                'value' => 'Únor',
            ],
            [
                'TranslationCode' => 'Month.January',
                'LanguageCode' => 'ENG',
                'value' => 'January',
            ],
            [
                'TranslationCode' => 'Month.January',
                'LanguageCode' => 'CZK',
                'value' => 'Leden',
            ],
            [
                'TranslationCode' => 'Month.July',
                'LanguageCode' => 'ENG',
                'value' => 'July',
            ],
            [
                'TranslationCode' => 'Month.July',
                'LanguageCode' => 'CZK',
                'value' => 'Červenec',
            ],
            [
                'TranslationCode' => 'Month.June',
                'LanguageCode' => 'ENG',
                'value' => 'June',
            ],
            [
                'TranslationCode' => 'Month.June',
                'LanguageCode' => 'CZK',
                'value' => 'Červen',
            ],
            [
                'TranslationCode' => 'Month.March',
                'LanguageCode' => 'ENG',
                'value' => 'March',
            ],
            [
                'TranslationCode' => 'Month.March',
                'LanguageCode' => 'CZK',
                'value' => 'Březen',
            ],
            [
                'TranslationCode' => 'Month.May',
                'LanguageCode' => 'ENG',
                'value' => 'May',
            ],
            [
                'TranslationCode' => 'Month.May',
                'LanguageCode' => 'CZK',
                'value' => 'Květen',
            ],
            [
                'TranslationCode' => 'Month.November',
                'LanguageCode' => 'ENG',
                'value' => 'November',
            ],
            [
                'TranslationCode' => 'Month.November',
                'LanguageCode' => 'CZK',
                'value' => 'Listopad',
            ],
            [
                'TranslationCode' => 'Month.October',
                'LanguageCode' => 'ENG',
                'value' => 'October',
            ],
            [
                'TranslationCode' => 'Month.October',
                'LanguageCode' => 'CZK',
                'value' => 'Říjen',
            ],
            [
                'TranslationCode' => 'Month.September',
                'LanguageCode' => 'ENG',
                'value' => 'September',
            ],
            [
                'TranslationCode' => 'Month.September',
                'LanguageCode' => 'CZK',
                'value' => 'Září',
            ],
            [
                'TranslationCode' => 'Navigation.Statistics',
                'LanguageCode' => 'ENG',
                'value' => 'Monthly preview',
            ],
            [
                'TranslationCode' => 'Navigation.Statistics',
                'LanguageCode' => 'CZK',
                'value' => 'Měsíční přehled',
            ],
            [
                'TranslationCode' => 'Navigation.UpdateItem',
                'LanguageCode' => 'ENG',
                'value' => 'Update item',
            ],
            [
                'TranslationCode' => 'Navigation.UpdateItem',
                'LanguageCode' => 'CZK',
                'value' => 'Upravit položku',
            ],
            [
                'TranslationCode' => 'Navigation.Wallet',
                'LanguageCode' => 'ENG',
                'value' => 'Wallet',
            ],
            [
                'TranslationCode' => 'Navigation.Wallet',
                'LanguageCode' => 'CZK',
                'value' => 'Peněženka',
            ],
            [
                'TranslationCode' => 'Navigation.Wallet.Archive',
                'LanguageCode' => 'ENG',
                'value' => 'Archive',
            ],
            [
                'TranslationCode' => 'Navigation.Wallet.Archive',
                'LanguageCode' => 'CZK',
                'value' => 'Archiv',
            ],
            [
                'TranslationCode' => 'Navigation.Wallet.Incomes',
                'LanguageCode' => 'ENG',
                'value' => 'Incomes',
            ],
            [
                'TranslationCode' => 'Navigation.Wallet.Incomes',
                'LanguageCode' => 'CZK',
                'value' => 'Příjmy',
            ],
            [
                'TranslationCode' => 'No',
                'LanguageCode' => 'ENG',
                'value' => 'NO',
            ],
            [
                'TranslationCode' => 'No',
                'LanguageCode' => 'CZK',
                'value' => 'NE',
            ],
            [
                'TranslationCode' => 'OldItems.Heading1',
                'LanguageCode' => 'ENG',
                'value' => 'Archive',
            ],
            [
                'TranslationCode' => 'OldItems.Heading1',
                'LanguageCode' => 'CZK',
                'value' => 'Archiv',
            ],
            [
                'TranslationCode' => 'PrintItems.CheckedItemTitle',
                'LanguageCode' => 'ENG',
                'value' => 'Move to archive',
            ],
            [
                'TranslationCode' => 'PrintItems.CheckedItemTitle',
                'LanguageCode' => 'CZK',
                'value' => 'Přesunout do archivu',
            ],
            [
                'TranslationCode' => 'PrintItems.DeleteItemTitle',
                'LanguageCode' => 'ENG',
                'value' => 'Delete item',
            ],
            [
                'TranslationCode' => 'PrintItems.DeleteItemTitle',
                'LanguageCode' => 'CZK',
                'value' => 'Smazat záznam',
            ],
            [
                'TranslationCode' => 'PrintItems.Description',
                'LanguageCode' => 'ENG',
                'value' => 'Description',
            ],
            [
                'TranslationCode' => 'PrintItems.Description',
                'LanguageCode' => 'CZK',
                'value' => 'Bližší popis',
            ],
            [
                'TranslationCode' => 'PrintItems.Filtering.Error.TwoSpaces',
                'LanguageCode' => 'ENG',
                'value' => 'Pattern started with two spaces!',
            ],
            [
                'TranslationCode' => 'PrintItems.Filtering.Error.TwoSpaces',
                'LanguageCode' => 'CZK',
                'value' => 'Řetězec začínal dvěma mezarama!',
            ],
            [
                'TranslationCode' => 'PrintItems.More.Button',
                'LanguageCode' => 'ENG',
                'value' => 'More',
            ],
            [
                'TranslationCode' => 'PrintItems.More.Button',
                'LanguageCode' => 'CZK',
                'value' => 'Dalších',
            ],
            [
                'TranslationCode' => 'PrintItems.Name',
                'LanguageCode' => 'ENG',
                'value' => 'Item name',
            ],
            [
                'TranslationCode' => 'PrintItems.Name',
                'LanguageCode' => 'CZK',
                'value' => 'Název položky',
            ],
            [
                'TranslationCode' => 'PrintItems.NoResults',
                'LanguageCode' => 'ENG',
                'value' => 'No results for this choice',
            ],
            [
                'TranslationCode' => 'PrintItems.NoResults',
                'LanguageCode' => 'CZK',
                'value' => 'Takovému výběru neodpovídají žádné výsledky',
            ],
            [
                'TranslationCode' => 'PrintItems.Note',
                'LanguageCode' => 'ENG',
                'value' => 'Note',
            ],
            [
                'TranslationCode' => 'PrintItems.Note',
                'LanguageCode' => 'CZK',
                'value' => 'Druh útraty',
            ],
            [
                'TranslationCode' => 'PrintItems.PayedBy.Card',
                'LanguageCode' => 'ENG',
                'value' => 'card',
            ],
            [
                'TranslationCode' => 'PrintItems.PayedBy.Card',
                'LanguageCode' => 'CZK',
                'value' => 'karta',
            ],
            [
                'TranslationCode' => 'PrintItems.PayedBy.Cash',
                'LanguageCode' => 'ENG',
                'value' => 'cash',
            ],
            [
                'TranslationCode' => 'PrintItems.PayedBy.Cash',
                'LanguageCode' => 'CZK',
                'value' => 'hotovost',
            ],
            [
                'TranslationCode' => 'PrintItems.Price',
                'LanguageCode' => 'ENG',
                'value' => 'Total price',
            ],
            [
                'TranslationCode' => 'PrintItems.Price',
                'LanguageCode' => 'CZK',
                'value' => 'Celková cena',
            ],
            [
                'TranslationCode' => 'PrintItems.TotalItemsPrice',
                'LanguageCode' => 'ENG',
                'value' => 'SUM:',
            ],
            [
                'TranslationCode' => 'PrintItems.TotalItemsPrice',
                'LanguageCode' => 'CZK',
                'value' => 'SUM:',
            ],
            [
                'TranslationCode' => 'PrintItems.TotalItemsSize',
                'LanguageCode' => 'ENG',
                'value' => 'Total items:',
            ],
            [
                'TranslationCode' => 'PrintItems.TotalItemsSize',
                'LanguageCode' => 'CZK',
                'value' => 'Celkem položek:',
            ],
            [
                'TranslationCode' => 'PrintItems.Type',
                'LanguageCode' => 'ENG',
                'value' => 'Payed by',
            ],
            [
                'TranslationCode' => 'PrintItems.Type',
                'LanguageCode' => 'CZK',
                'value' => 'Placeno',
            ],
            [
                'TranslationCode' => 'PrintItems.UpdateItemTitle',
                'LanguageCode' => 'ENG',
                'value' => 'Update item',
            ],
            [
                'TranslationCode' => 'PrintItems.UpdateItemTitle',
                'LanguageCode' => 'CZK',
                'value' => 'Aktualizovat položku',
            ],
            [
                'TranslationCode' => 'Purposes.Navigation',
                'LanguageCode' => 'ENG',
                'value' => 'Purpose management',
            ],
            [
                'TranslationCode' => 'Purposes.Navigation',
                'LanguageCode' => 'CZK',
                'value' => 'Správa druhů útrat',
            ],
            [
                'TranslationCode' => 'Register.Button',
                'LanguageCode' => 'ENG',
                'value' => 'Sign in',
            ],
            [
                'TranslationCode' => 'Register.Button',
                'LanguageCode' => 'CZK',
                'value' => 'Registrovat',
            ],
            [
                'TranslationCode' => 'Register.Form.Email.BadFormat',
                'LanguageCode' => 'ENG',
                'value' => 'E-mail in bad format',
            ],
            [
                'TranslationCode' => 'Register.Form.Email.BadFormat',
                'LanguageCode' => 'CZK',
                'value' => 'E-mail ve špatném formátu',
            ],
            [
                'TranslationCode' => 'Register.Form.Email.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty e-mail',
            ],
            [
                'TranslationCode' => 'Register.Form.Email.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný e-mail',
            ],
            [
                'TranslationCode' => 'Register.Form.Emil.Exists',
                'LanguageCode' => 'CZK',
                'value' => 'Tento e-mail již existuje',
            ],
            [
                'TranslationCode' => 'Register.Form.Login.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty login',
            ],
            [
                'TranslationCode' => 'Register.Form.Login.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný login',
            ],
            [
                'TranslationCode' => 'Register.Form.Login.Exists',
                'LanguageCode' => 'ENG',
                'value' => 'This login already exists',
            ],
            [
                'TranslationCode' => 'Register.Form.Login.Exists',
                'LanguageCode' => 'CZK',
                'value' => 'Tento login již existuje',
            ],
            [
                'TranslationCode' => 'Register.Form.Login.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'login',
            ],
            [
                'TranslationCode' => 'Register.Form.Login.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'login',
            ],
            [
                'TranslationCode' => 'Register.Form.Login.Short',
                'LanguageCode' => 'ENG',
                'value' => 'Login too short (< {%d} chars)',
            ],
            [
                'TranslationCode' => 'Register.Form.Login.Short',
                'LanguageCode' => 'CZK',
                'value' => 'Příliš krátký login (< {%d} znaků)',
            ],
            [
                'TranslationCode' => 'Register.Form.Password',
                'LanguageCode' => 'ENG',
                'value' => 'Password:',
            ],
            [
                'TranslationCode' => 'Register.Form.Password',
                'LanguageCode' => 'CZK',
                'value' => 'Heslo:',
            ],
            [
                'TranslationCode' => 'Register.Form.Password.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty password',
            ],
            [
                'TranslationCode' => 'Register.Form.Password.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněné heslo',
            ],
            [
                'TranslationCode' => 'Register.Form.Password.NotSame',
                'LanguageCode' => 'ENG',
                'value' => 'Passwords are not same',
            ],
            [
                'TranslationCode' => 'Register.Form.Password.NotSame',
                'LanguageCode' => 'CZK',
                'value' => 'Hesla nejsou stejné',
            ],
            [
                'TranslationCode' => 'Register.Form.Password.Short',
                'LanguageCode' => 'ENG',
                'value' => 'Password too short (< {%d} chars)',
            ],
            [
                'TranslationCode' => 'Register.Form.Password.Short',
                'LanguageCode' => 'CZK',
                'value' => 'Heslo příliš krátké (< {%d} znaků)',
            ],
            [
                'TranslationCode' => 'Register.H1',
                'LanguageCode' => 'ENG',
                'value' => 'Sign in',
            ],
            [
                'TranslationCode' => 'Register.H1',
                'LanguageCode' => 'CZK',
                'value' => 'Registrace',
            ],
            [
                'TranslationCode' => 'SendToParent.Button',
                'LanguageCode' => 'ENG',
                'value' => 'E-mail preview',
            ],
            [
                'TranslationCode' => 'SendToParent.Button',
                'LanguageCode' => 'CZK',
                'value' => 'Náhled e-mailu',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.For',
                'LanguageCode' => 'ENG',
                'value' => 'For',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.For',
                'LanguageCode' => 'CZK',
                'value' => 'Za',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.FromMonth',
                'LanguageCode' => 'ENG',
                'value' => 'Audit for',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.FromMonth',
                'LanguageCode' => 'CZK',
                'value' => 'Vyúčtování za',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.FromYear',
                'LanguageCode' => 'ENG',
                'value' => 'of year',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.FromYear',
                'LanguageCode' => 'CZK',
                'value' => 'roku',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.Intro',
                'LanguageCode' => 'ENG',
                'value' => 'Message content',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.Intro',
                'LanguageCode' => 'CZK',
                'value' => 'Text zprávy',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.Items',
                'LanguageCode' => 'ENG',
                'value' => 'items',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.Items',
                'LanguageCode' => 'CZK',
                'value' => 'položek',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.ItemsCount',
                'LanguageCode' => 'ENG',
                'value' => 'Number of items',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.ItemsCount',
                'LanguageCode' => 'CZK',
                'value' => 'Počet položek',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.Send',
                'LanguageCode' => 'ENG',
                'value' => 'Really send',
            ],
            [
                'TranslationCode' => 'SendToParent.Preview.Send',
                'LanguageCode' => 'CZK',
                'value' => 'Opravdu poslat',
            ],
            [
                'TranslationCode' => 'SendToParent.Sent.ToDate',
                'LanguageCode' => 'ENG',
                'value' => 'Audit for',
            ],
            [
                'TranslationCode' => 'SendToParent.Sent.ToDate',
                'LanguageCode' => 'CZK',
                'value' => 'Účetnictví za',
            ],
            [
                'TranslationCode' => 'SendToParent.Sent.ToMail',
                'LanguageCode' => 'ENG',
                'value' => 'send to',
            ],
            [
                'TranslationCode' => 'SendToParent.Sent.ToMail',
                'LanguageCode' => 'CZK',
                'value' => 'odesláno na',
            ],
            [
                'TranslationCode' => 'SendToParent.Year',
                'LanguageCode' => 'ENG',
                'value' => 'year',
            ],
            [
                'TranslationCode' => 'SendToParent.Year',
                'LanguageCode' => 'CZK',
                'value' => 'rok',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.Login',
                'LanguageCode' => 'ENG',
                'value' => 'Wrong filled login',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.Login',
                'LanguageCode' => 'CZK',
                'value' => 'Špatně vyplněný login',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.MailToParent',
                'LanguageCode' => 'ENG',
                'value' => 'Wrong filled mail to parent',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.MailToParent',
                'LanguageCode' => 'CZK',
                'value' => 'Špatně vyplněný mail na rodiče',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.Name',
                'LanguageCode' => 'ENG',
                'value' => 'Wrong filled name',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.Name',
                'LanguageCode' => 'CZK',
                'value' => 'Špatně vyplněné jméno',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.Password',
                'LanguageCode' => 'ENG',
                'value' => 'Wrong filled password',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.Password',
                'LanguageCode' => 'CZK',
                'value' => 'Špatně vyplněné heslo',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.PasswordAgain',
                'LanguageCode' => 'ENG',
                'value' => 'Wrong filled password',
            ],
            [
                'TranslationCode' => 'Settings.Form.Alert.PasswordAgain',
                'LanguageCode' => 'CZK',
                'value' => 'Špatně vyplněné heslo',
            ],
            [
                'TranslationCode' => 'Settings.Form.Change',
                'LanguageCode' => 'ENG',
                'value' => 'Change',
            ],
            [
                'TranslationCode' => 'Settings.Form.Change',
                'LanguageCode' => 'CZK',
                'value' => 'Změnit',
            ],
            [
                'TranslationCode' => 'Settings.Form.ChangePassword.CheckBox',
                'LanguageCode' => 'ENG',
                'value' => 'Change password',
            ],
            [
                'TranslationCode' => 'Settings.Form.ChangePassword.CheckBox',
                'LanguageCode' => 'CZK',
                'value' => 'Změnit heslo',
            ],
            [
                'TranslationCode' => 'Settings.Form.ConfirmPassword',
                'LanguageCode' => 'ENG',
                'value' => 'Confirm password:',
            ],
            [
                'TranslationCode' => 'Settings.Form.ConfirmPassword',
                'LanguageCode' => 'CZK',
                'value' => 'Potvrzení heslo:',
            ],
            [
                'TranslationCode' => 'Settings.Form.ConfirmPassword.NotSame',
                'LanguageCode' => 'ENG',
                'value' => 'passwords not match',
            ],
            [
                'TranslationCode' => 'Settings.Form.ConfirmPassword.NotSame',
                'LanguageCode' => 'CZK',
                'value' => 'hesla se neshodují',
            ],
            [
                'TranslationCode' => 'Settings.Form.ConfirmPassword.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'password againn',
            ],
            [
                'TranslationCode' => 'Settings.Form.ConfirmPassword.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'heslo znova',
            ],
            [
                'TranslationCode' => 'Settings.Form.Currency',
                'LanguageCode' => 'ENG',
                'value' => 'Currency:',
            ],
            [
                'TranslationCode' => 'Settings.Form.Currency',
                'LanguageCode' => 'CZK',
                'value' => 'Měna:',
            ],
            [
                'TranslationCode' => 'Settings.Form.FirstName',
                'LanguageCode' => 'ENG',
                'value' => 'Name:',
            ],
            [
                'TranslationCode' => 'Settings.Form.FirstName',
                'LanguageCode' => 'CZK',
                'value' => 'Jméno:',
            ],
            [
                'TranslationCode' => 'Settings.Form.FirstName.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty first name',
            ],
            [
                'TranslationCode' => 'Settings.Form.FirstName.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněné jméno',
            ],
            [
                'TranslationCode' => 'Settings.Form.FirstName.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'John',
            ],
            [
                'TranslationCode' => 'Settings.Form.FirstName.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'Jan',
            ],
            [
                'TranslationCode' => 'Settings.Form.Form.MyMail',
                'LanguageCode' => 'ENG',
                'value' => 'Empty e-mail address',
            ],
            [
                'TranslationCode' => 'Settings.Form.Form.MyMail.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněná e-mailová adresa',
            ],
            [
                'TranslationCode' => 'Settings.Form.KindsOfSpend',
                'LanguageCode' => 'ENG',
                'value' => 'Kind of charges:',
            ],
            [
                'TranslationCode' => 'Settings.Form.KindsOfSpend',
                'LanguageCode' => 'CZK',
                'value' => 'Druhy útraty:',
            ],
            [
                'TranslationCode' => 'Settings.Form.Language',
                'LanguageCode' => 'ENG',
                'value' => 'Language:',
            ],
            [
                'TranslationCode' => 'Settings.Form.Language',
                'LanguageCode' => 'CZK',
                'value' => 'Jazyk:',
            ],
            [
                'TranslationCode' => 'Settings.Form.LastName',
                'LanguageCode' => 'ENG',
                'value' => 'Last name:',
            ],
            [
                'TranslationCode' => 'Settings.Form.LastName',
                'LanguageCode' => 'CZK',
                'value' => 'Příjmení:',
            ],
            [
                'TranslationCode' => 'Settings.Form.LastName.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Emty last name',
            ],
            [
                'TranslationCode' => 'Settings.Form.LastName.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněné příjmení',
            ],
            [
                'TranslationCode' => 'Settings.Form.LastName.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'Doe',
            ],
            [
                'TranslationCode' => 'Settings.Form.LastName.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'Novák',
            ],
            [
                'TranslationCode' => 'Settings.Form.Login',
                'LanguageCode' => 'ENG',
                'value' => 'Login:',
            ],
            [
                'TranslationCode' => 'Settings.Form.Login',
                'LanguageCode' => 'CZK',
                'value' => 'Login:',
            ],
            [
                'TranslationCode' => 'Settings.Form.Login.AlreadyExists',
                'LanguageCode' => 'ENG',
                'value' => 'This value is already taken',
            ],
            [
                'TranslationCode' => 'Settings.Form.Login.AlreadyExists',
                'LanguageCode' => 'CZK',
                'value' => 'Tato hodnota je již zabraná',
            ],
            [
                'TranslationCode' => 'Settings.Form.Login.SomeError',
                'LanguageCode' => 'ENG',
                'value' => 'Some error',
            ],
            [
                'TranslationCode' => 'Settings.Form.Login.SomeError',
                'LanguageCode' => 'CZK',
                'value' => 'Nějaká chyba',
            ],
            [
                'TranslationCode' => 'Settings.Form.Login.TooShort',
                'LanguageCode' => 'ENG',
                'value' => 'too short (< {%d} chars)',
            ],
            [
                'TranslationCode' => 'Settings.Form.Login.TooShort',
                'LanguageCode' => 'CZK',
                'value' => 'příliš krátké (< {%d} znaků)',
            ],
            [
                'TranslationCode' => 'Settings.Form.Mail.BadFormat',
                'LanguageCode' => 'ENG',
                'value' => 'Wrong format',
            ],
            [
                'TranslationCode' => 'Settings.Form.Mail.BadFormat',
                'LanguageCode' => 'CZK',
                'value' => 'Špatný formát',
            ],
            [
                'TranslationCode' => 'Settings.Form.MailToMe',
                'LanguageCode' => 'ENG',
                'value' => 'Mail to me:',
            ],
            [
                'TranslationCode' => 'Settings.Form.MailToMe',
                'LanguageCode' => 'CZK',
                'value' => 'Mail na mě:',
            ],
            [
                'TranslationCode' => 'Settings.Form.MailToParent',
                'LanguageCode' => 'ENG',
                'value' => 'Mail to parent:',
            ],
            [
                'TranslationCode' => 'Settings.Form.MailToParent',
                'LanguageCode' => 'CZK',
                'value' => 'Mail na rodiče:',
            ],
            [
                'TranslationCode' => 'Settings.Form.ManageNotes',
                'LanguageCode' => 'ENG',
                'value' => 'Manage notes',
            ],
            [
                'TranslationCode' => 'Settings.Form.ManageNotes',
                'LanguageCode' => 'CZK',
                'value' => 'Spravovat druhy útraty',
            ],
            [
                'TranslationCode' => 'Settings.Form.NoteAdd.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty kind of expende',
            ],
            [
                'TranslationCode' => 'Settings.Form.NoteAdd.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný druh útraty',
            ],
            [
                'TranslationCode' => 'Settings.Form.OldPassword',
                'LanguageCode' => 'ENG',
                'value' => 'Old password:',
            ],
            [
                'TranslationCode' => 'Settings.Form.OldPassword',
                'LanguageCode' => 'CZK',
                'value' => 'Nynější heslo:',
            ],
            [
                'TranslationCode' => 'Settings.Form.OldPassword.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'password',
            ],
            [
                'TranslationCode' => 'Settings.Form.OldPassword.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'heslo',
            ],
            [
                'TranslationCode' => 'Settings.Form.Password',
                'LanguageCode' => 'ENG',
                'value' => 'Password change:',
            ],
            [
                'TranslationCode' => 'Settings.Form.Password',
                'LanguageCode' => 'CZK',
                'value' => 'Změna hesla:',
            ],
            [
                'TranslationCode' => 'Settings.Form.Password.BadSecurity',
                'LanguageCode' => 'ENG',
                'value' => 'At least 2 property of [a-z], [A-Z] and [0-9]',
            ],
            [
                'TranslationCode' => 'Settings.Form.Password.BadSecurity',
                'LanguageCode' => 'CZK',
                'value' => 'Alespoň 2 vlastnosti z [a-z], [A-Z] a [0-9]',
            ],
            [
                'TranslationCode' => 'Settings.Form.Password.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'password',
            ],
            [
                'TranslationCode' => 'Settings.Form.Password.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'heslo',
            ],
            [
                'TranslationCode' => 'Settings.Form.Password.TooShort',
                'LanguageCode' => 'ENG',
                'value' => 'too short (< {%d} chars)',
            ],
            [
                'TranslationCode' => 'Settings.Form.Password.TooShort',
                'LanguageCode' => 'CZK',
                'value' => 'příliš krátké (< {%d} znaků)',
            ],
            [
                'TranslationCode' => 'Settings.Form.Result.Error',
                'LanguageCode' => 'ENG',
                'value' => 'Something gone wrong',
            ],
            [
                'TranslationCode' => 'Settings.Form.Result.Error',
                'LanguageCode' => 'CZK',
                'value' => 'Něco se pokazilo',
            ],
            [
                'TranslationCode' => 'Settings.Form.Result.Success',
                'LanguageCode' => 'ENG',
                'value' => 'Everything changed',
            ],
            [
                'TranslationCode' => 'Settings.Form.Result.Success',
                'LanguageCode' => 'CZK',
                'value' => 'Vše změněno',
            ],
            [
                'TranslationCode' => 'Settings.Form.SendByOne',
                'LanguageCode' => 'ENG',
                'value' => 'Send to parent every added item:',
            ],
            [
                'TranslationCode' => 'Settings.Form.SendByOne',
                'LanguageCode' => 'CZK',
                'value' => 'Posílat rodiči každou položku:',
            ],
            [
                'TranslationCode' => 'Settings.Form.SendMonthly',
                'LanguageCode' => 'ENG',
                'value' => 'Ability to send monthly expense:',
            ],
            [
                'TranslationCode' => 'Settings.Form.SendMonthly',
                'LanguageCode' => 'CZK',
                'value' => 'Možnost posílat měsíční výpis:',
            ],
            [
                'TranslationCode' => 'Settings.Heading',
                'LanguageCode' => 'ENG',
                'value' => 'settings',
            ],
            [
                'TranslationCode' => 'Settings.Heading',
                'LanguageCode' => 'CZK',
                'value' => 'nastavení',
            ],
            [
                'TranslationCode' => 'ShowItems.CheckAll.Alert',
                'LanguageCode' => 'ENG',
                'value' => 'Do you really want to archive all displayed items?',
            ],
            [
                'TranslationCode' => 'ShowItems.CheckAll.Alert',
                'LanguageCode' => 'CZK',
                'value' => 'Chcete přesunout do archivu všechny tyto položky?',
            ],
            [
                'TranslationCode' => 'ShowItems.CheckAll.Title',
                'LanguageCode' => 'ENG',
                'value' => 'Archive all pisplayed items',
            ],
            [
                'TranslationCode' => 'ShowItems.CheckAll.Title',
                'LanguageCode' => 'CZK',
                'value' => 'Přesunout do archivu všechny zobrazené',
            ],
            [
                'TranslationCode' => 'ShowItems.Delete.Alert',
                'LanguageCode' => 'ENG',
                'value' => 'Do you really want to delete this item?',
            ],
            [
                'TranslationCode' => 'ShowItems.Delete.Alert',
                'LanguageCode' => 'CZK',
                'value' => 'Opravdu chceš smazat?',
            ],
            [
                'TranslationCode' => 'Statistics.Description',
                'LanguageCode' => 'ENG',
                'value' => 'Here you can look at the statistics as of the month you are due to the previous months. Choose if you want to review a specific note or everything.',
            ],
            [
                'TranslationCode' => 'Statistics.Description',
                'LanguageCode' => 'CZK',
                'value' => 'Zde se můžete podívat na statistiku, jak na tom tento měsíc jste vzhledem k předešlým měsícům. Vybrat si můžete, jestli chcete přehled konkrétního druhu útraty, či všeho.',
            ],
            [
                'TranslationCode' => 'Statistics.Filtering.NotesLabel',
                'LanguageCode' => 'ENG',
                'value' => 'Statistics for specific note:',
            ],
            [
                'TranslationCode' => 'Statistics.Filtering.NotesLabel',
                'LanguageCode' => 'CZK',
                'value' => 'Statistika pro určitý druh útraty:',
            ],
            [
                'TranslationCode' => 'Statistics.Filtering.Types.Default',
                'LanguageCode' => 'ENG',
                'value' => '--note--',
            ],
            [
                'TranslationCode' => 'Statistics.Filtering.Types.Default',
                'LanguageCode' => 'CZK',
                'value' => '--druh útraty--',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Average',
                'LanguageCode' => 'ENG',
                'value' => 'AVERAGE:',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Average',
                'LanguageCode' => 'CZK',
                'value' => 'PRŮMĚRNĚ:',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Date',
                'LanguageCode' => 'ENG',
                'value' => 'Month',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Date',
                'LanguageCode' => 'CZK',
                'value' => 'Měsíc',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Max',
                'LanguageCode' => 'ENG',
                'value' => 'MAX:',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Max',
                'LanguageCode' => 'CZK',
                'value' => 'MAX:',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Min',
                'LanguageCode' => 'ENG',
                'value' => 'MIN:',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Min',
                'LanguageCode' => 'CZK',
                'value' => 'MIN:',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Percentage',
                'LanguageCode' => 'ENG',
                'value' => 'Percentage',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Percentage',
                'LanguageCode' => 'CZK',
                'value' => 'Procento:',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.ThisMonth',
                'LanguageCode' => 'ENG',
                'value' => 'This month',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.ThisMonth',
                'LanguageCode' => 'CZK',
                'value' => 'Tento měsíc',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Value',
                'LanguageCode' => 'ENG',
                'value' => 'Expense',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.Extremes.Value',
                'LanguageCode' => 'CZK',
                'value' => 'Útrata',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.H2',
                'LanguageCode' => 'ENG',
                'value' => 'Comparison with whole months',
            ],
            [
                'TranslationCode' => 'Statistics.FullMonth.H2',
                'LanguageCode' => 'CZK',
                'value' => 'Srovnání s celými měsíci',
            ],
            [
                'TranslationCode' => 'Statistics.H1',
                'LanguageCode' => 'ENG',
                'value' => 'Monthly preview of wallet',
            ],
            [
                'TranslationCode' => 'Statistics.H1',
                'LanguageCode' => 'CZK',
                'value' => 'Měsíční přehled peněženky',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Average',
                'LanguageCode' => 'ENG',
                'value' => 'AVERAGE:',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Average',
                'LanguageCode' => 'CZK',
                'value' => 'PRŮMĚR:',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Date',
                'LanguageCode' => 'ENG',
                'value' => 'Month',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Date',
                'LanguageCode' => 'CZK',
                'value' => 'Měsíc',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Max',
                'LanguageCode' => 'ENG',
                'value' => 'MAX:',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Max',
                'LanguageCode' => 'CZK',
                'value' => 'MAX:',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Min',
                'LanguageCode' => 'ENG',
                'value' => 'MIN:',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Min',
                'LanguageCode' => 'CZK',
                'value' => 'MIN:',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Percentage',
                'LanguageCode' => 'ENG',
                'value' => 'Percentage',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Percentage',
                'LanguageCode' => 'CZK',
                'value' => 'Procento',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.ThisMonth',
                'LanguageCode' => 'ENG',
                'value' => 'This month',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.ThisMonth',
                'LanguageCode' => 'CZK',
                'value' => 'Tento měsíc',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Value',
                'LanguageCode' => 'ENG',
                'value' => 'Expense',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.Extremes.Value',
                'LanguageCode' => 'CZK',
                'value' => 'Útrata',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.H2',
                'LanguageCode' => 'ENG',
                'value' => 'Comparsion with months since {%d}th of each month',
            ],
            [
                'TranslationCode' => 'Statistics.PartMonth.H2',
                'LanguageCode' => 'CZK',
                'value' => 'Srovnání s měsíci do {%d}. každého měsíce',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.Expense',
                'LanguageCode' => 'ENG',
                'value' => 'Expense',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.Expense',
                'LanguageCode' => 'CZK',
                'value' => 'Útrata',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.ExpensesCnt',
                'LanguageCode' => 'ENG',
                'value' => '#expenses',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.ExpensesCnt',
                'LanguageCode' => 'CZK',
                'value' => 'položek',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.Income',
                'LanguageCode' => 'ENG',
                'value' => 'Income',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.Income',
                'LanguageCode' => 'CZK',
                'value' => 'Příjem',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.IncomesCnt',
                'LanguageCode' => 'ENG',
                'value' => '#incomes',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.IncomesCnt',
                'LanguageCode' => 'CZK',
                'value' => 'položek',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.Percentage',
                'LanguageCode' => 'ENG',
                'value' => 'Percentage',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.Percentage',
                'LanguageCode' => 'CZK',
                'value' => 'Procento',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.Season',
                'LanguageCode' => 'ENG',
                'value' => 'Month',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.Season',
                'LanguageCode' => 'CZK',
                'value' => 'Měsíc',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.ThisMonth',
                'LanguageCode' => 'ENG',
                'value' => 'Expense of this month',
            ],
            [
                'TranslationCode' => 'Statistics.TableFull.Head.ThisMonth',
                'LanguageCode' => 'CZK',
                'value' => 'Útrata tohoto měsíce',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.Expense',
                'LanguageCode' => 'ENG',
                'value' => 'Monthly expense',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.Expense',
                'LanguageCode' => 'CZK',
                'value' => 'Útrata',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.ExpensesCnt',
                'LanguageCode' => 'ENG',
                'value' => '#expenses',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.ExpensesCnt',
                'LanguageCode' => 'CZK',
                'value' => 'položek',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.Income',
                'LanguageCode' => 'ENG',
                'value' => 'Monthly income',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.Income',
                'LanguageCode' => 'CZK',
                'value' => 'Příjem',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.IncomesCnt',
                'LanguageCode' => 'ENG',
                'value' => '#incomes',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.IncomesCnt',
                'LanguageCode' => 'CZK',
                'value' => 'položek',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.Percentage',
                'LanguageCode' => 'ENG',
                'value' => 'Percentage',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.Percentage',
                'LanguageCode' => 'CZK',
                'value' => 'Procento',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.Season',
                'LanguageCode' => 'ENG',
                'value' => 'Month',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.Season',
                'LanguageCode' => 'CZK',
                'value' => 'Měsíc',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.ThisMonth',
                'LanguageCode' => 'ENG',
                'value' => 'Expense of this month',
            ],
            [
                'TranslationCode' => 'Statistics.TablePart.Head.ThisMonth',
                'LanguageCode' => 'CZK',
                'value' => 'Útrata tohoto měsíce',
            ],
            [
                'TranslationCode' => 'Status.Card',
                'LanguageCode' => 'ENG',
                'value' => 'Rest on card',
            ],
            [
                'TranslationCode' => 'Status.Card',
                'LanguageCode' => 'CZK',
                'value' => 'Zůstatek na kartě',
            ],
            [
                'TranslationCode' => 'Status.Cash',
                'LanguageCode' => 'ENG',
                'value' => 'Rest in cash',
            ],
            [
                'TranslationCode' => 'Status.Cash',
                'LanguageCode' => 'CZK',
                'value' => 'Zůstatek v hotovosti',
            ],
            [
                'TranslationCode' => 'Title',
                'LanguageCode' => 'ENG',
                'value' => '\'s expense',
            ],
            [
                'TranslationCode' => 'Title',
                'LanguageCode' => 'CZK',
                'value' => ' - útrata',
            ],
            [
                'TranslationCode' => 'Title.AddItem',
                'LanguageCode' => 'ENG',
                'value' => 'Add item',
            ],
            [
                'TranslationCode' => 'Title.AddItem',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat položku',
            ],
            [
                'TranslationCode' => 'Title.AddWallet',
                'LanguageCode' => 'ENG',
                'value' => 'Add wallet',
            ],
            [
                'TranslationCode' => 'Title.AddWallet',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat peněženku',
            ],
            [
                'TranslationCode' => 'Title.Notes.Manage',
                'LanguageCode' => 'ENG',
                'value' => 'Manage notes',
            ],
            [
                'TranslationCode' => 'Title.Notes.Manage',
                'LanguageCode' => 'CZK',
                'value' => 'Správa druhů útrat',
            ],
            [
                'TranslationCode' => 'Titles.Settings',
                'LanguageCode' => 'ENG',
                'value' => 'Settings',
            ],
            [
                'TranslationCode' => 'Titles.Settings',
                'LanguageCode' => 'CZK',
                'value' => 'Nastavení',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Course.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty course',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Course.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný kurz',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Date.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty date',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Date.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný datum',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Name.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty name',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Name.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný název',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Price.BadFormat',
                'LanguageCode' => 'ENG',
                'value' => 'Price in bad format',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Price.BadFormat',
                'LanguageCode' => 'CZK',
                'value' => 'Cena ve špatném formátu',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Price.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty price',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Error.Price.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněná cena',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.AnotherCurrency',
                'LanguageCode' => 'ENG',
                'value' => 'other currency',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.AnotherCurrency',
                'LanguageCode' => 'CZK',
                'value' => 'jiná měna',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Currency',
                'LanguageCode' => 'ENG',
                'value' => 'Currency:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Currency',
                'LanguageCode' => 'CZK',
                'value' => 'Měna:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.CurrencyCourse',
                'LanguageCode' => 'ENG',
                'value' => 'course:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.CurrencyCourse',
                'LanguageCode' => 'CZK',
                'value' => 'kurz:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Date',
                'LanguageCode' => 'ENG',
                'value' => 'Date:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Date',
                'LanguageCode' => 'CZK',
                'value' => 'Datum:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Heading',
                'LanguageCode' => 'ENG',
                'value' => 'Change income',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Heading',
                'LanguageCode' => 'CZK',
                'value' => 'Upravit příjem',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Name',
                'LanguageCode' => 'ENG',
                'value' => 'Short description:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Name',
                'LanguageCode' => 'CZK',
                'value' => 'Krátký popis:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Price',
                'LanguageCode' => 'ENG',
                'value' => 'Price:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Price',
                'LanguageCode' => 'CZK',
                'value' => 'Cena:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Save',
                'LanguageCode' => 'ENG',
                'value' => 'Store',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Save',
                'LanguageCode' => 'CZK',
                'value' => 'Vytvořit',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Storno',
                'LanguageCode' => 'ENG',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Storno',
                'LanguageCode' => 'CZK',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Type',
                'LanguageCode' => 'ENG',
                'value' => 'Type:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Type',
                'LanguageCode' => 'CZK',
                'value' => 'Typ:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Type.Card',
                'LanguageCode' => 'ENG',
                'value' => 'To card',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Type.Card',
                'LanguageCode' => 'CZK',
                'value' => 'Na kartu',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Type.Cash',
                'LanguageCode' => 'ENG',
                'value' => 'In cash',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Type.Cash',
                'LanguageCode' => 'CZK',
                'value' => 'V hotovosti',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Wallet',
                'LanguageCode' => 'ENG',
                'value' => 'Wallet:',
            ],
            [
                'TranslationCode' => 'UpdateIncome.Form.Wallet',
                'LanguageCode' => 'CZK',
                'value' => 'Peněženka:',
            ],
            [
                'TranslationCode' => 'UpdateItem.AlreadyUpdating',
                'LanguageCode' => 'ENG',
                'value' => 'Update already in progress',
            ],
            [
                'TranslationCode' => 'UpdateItem.AlreadyUpdating',
                'LanguageCode' => 'CZK',
                'value' => 'Již se aktualizuje položka',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Course.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty course',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Course.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněný kurz',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Date.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty date',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Date.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněné datum',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Name.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty name',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Name.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněné jméno',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Price.BadFormat',
                'LanguageCode' => 'ENG',
                'value' => 'Wrong price',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Price.BadFormat',
                'LanguageCode' => 'CZK',
                'value' => 'Špatná cena',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Price.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty price',
            ],
            [
                'TranslationCode' => 'UpdateItem.Error.Price.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněná cena',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.AnotherCurrency',
                'LanguageCode' => 'ENG',
                'value' => 'other currency',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.AnotherCurrency',
                'LanguageCode' => 'CZK',
                'value' => 'jiná měna',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Course',
                'LanguageCode' => 'ENG',
                'value' => 'course:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Course',
                'LanguageCode' => 'CZK',
                'value' => 'kurz:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Currency',
                'LanguageCode' => 'ENG',
                'value' => 'Currency:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Currency',
                'LanguageCode' => 'CZK',
                'value' => 'Měna:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Date',
                'LanguageCode' => 'ENG',
                'value' => 'Date:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Date',
                'LanguageCode' => 'CZK',
                'value' => 'Datum:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Description',
                'LanguageCode' => 'ENG',
                'value' => 'Description:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Description',
                'LanguageCode' => 'CZK',
                'value' => 'Popis:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Heading',
                'LanguageCode' => 'ENG',
                'value' => 'Update item form',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Heading',
                'LanguageCode' => 'CZK',
                'value' => 'Úprava položky',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Name',
                'LanguageCode' => 'ENG',
                'value' => 'Name:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Name',
                'LanguageCode' => 'CZK',
                'value' => 'Název:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Odepsat',
                'LanguageCode' => 'ENG',
                'value' => 'My expense:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Odepsat',
                'LanguageCode' => 'CZK',
                'value' => 'Odepsat:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Price',
                'LanguageCode' => 'ENG',
                'value' => 'Price:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Price',
                'LanguageCode' => 'CZK',
                'value' => 'Cena:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Purpose',
                'LanguageCode' => 'ENG',
                'value' => 'Note:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Purpose',
                'LanguageCode' => 'CZK',
                'value' => 'Druh útraty:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Save',
                'LanguageCode' => 'ENG',
                'value' => 'Update',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Save',
                'LanguageCode' => 'CZK',
                'value' => 'Upravit',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Storno',
                'LanguageCode' => 'ENG',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Storno',
                'LanguageCode' => 'CZK',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Type',
                'LanguageCode' => 'ENG',
                'value' => 'Type:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Type',
                'LanguageCode' => 'CZK',
                'value' => 'Typ:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Type.Card',
                'LanguageCode' => 'ENG',
                'value' => 'Card',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Type.Card',
                'LanguageCode' => 'CZK',
                'value' => 'Karta',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Type.Cash',
                'LanguageCode' => 'ENG',
                'value' => 'Cash',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Type.Cash',
                'LanguageCode' => 'CZK',
                'value' => 'Hotovost',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Wallet',
                'LanguageCode' => 'ENG',
                'value' => 'Wallet:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Form.Wallet',
                'LanguageCode' => 'CZK',
                'value' => 'Peněženka:',
            ],
            [
                'TranslationCode' => 'UpdateItem.Storno',
                'LanguageCode' => 'ENG',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'UpdateItem.Storno',
                'LanguageCode' => 'CZK',
                'value' => 'Storno',
            ],
            [
                'TranslationCode' => 'UpdateItem.Update',
                'LanguageCode' => 'ENG',
                'value' => 'Save',
            ],
            [
                'TranslationCode' => 'UpdateItem.Update',
                'LanguageCode' => 'CZK',
                'value' => 'Uložit',
            ],
            [
                'TranslationCode' => 'Uploading.Error.Again',
                'LanguageCode' => 'ENG',
                'value' => 'Error durning uploading file. Please try it again',
            ],
            [
                'TranslationCode' => 'Uploading.Error.Again',
                'LanguageCode' => 'CZK',
                'value' => 'Chyba při načítání souboru. Zkuste to prosím později',
            ],
            [
                'TranslationCode' => 'Uploading.Error.NoCSV',
                'LanguageCode' => 'ENG',
                'value' => 'The file is not of CSV type',
            ],
            [
                'TranslationCode' => 'Uploading.Error.NoCSV',
                'LanguageCode' => 'CZK',
                'value' => 'Soubor není typu CSV',
            ],
            [
                'TranslationCode' => 'Uploading.Error.NoFile',
                'LanguageCode' => 'ENG',
                'value' => 'Must choose some file',
            ],
            [
                'TranslationCode' => 'Uploading.Error.NoFile',
                'LanguageCode' => 'CZK',
                'value' => 'Vyberte nějaký soubor',
            ],
            [
                'TranslationCode' => 'Uploading.Success',
                'LanguageCode' => 'ENG',
                'value' => 'File uploaded',
            ],
            [
                'TranslationCode' => 'Uploading.Success',
                'LanguageCode' => 'CZK',
                'value' => 'Soubor nahrán',
            ],
            [
                'TranslationCode' => 'Uploading.Upload.Button',
                'LanguageCode' => 'ENG',
                'value' => 'Choose file',
            ],
            [
                'TranslationCode' => 'Uploading.Upload.Button',
                'LanguageCode' => 'CZK',
                'value' => 'Vybrat soubor',
            ],
            [
                'TranslationCode' => 'Uvod.DownloadBackUp.ErrorOcured',
                'LanguageCode' => 'ENG',
                'value' => 'Error ocures',
            ],
            [
                'TranslationCode' => 'Uvod.DownloadBackUp.ErrorOcured',
                'LanguageCode' => 'CZK',
                'value' => 'Vyskytla se chyba',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.AndMonth',
                'LanguageCode' => 'ENG',
                'value' => 'and select only',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.AndMonth',
                'LanguageCode' => 'CZK',
                'value' => 'a vybrat pouze',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.HelpTitle',
                'LanguageCode' => 'ENG',
                'value' => 'Every string delimite by two spaces, for typing two spaces type \'\\ \\ \'.&#010;\'!\' before string - string which is nowhere in every item for typing exclamation mark use expresion \'\\!\'',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.HelpTitle',
                'LanguageCode' => 'CZK',
                'value' => 'jednotlivé řetězce oddělujte dvěma mezerama, pro napsání dvou mezer napiště \'\\ \\ \'.&#010;\'!\' před řetězcem - řetězec, který se v položce nikde nevyskytuje. Pro napsání vykřičníku použijte výraz \'\\!\'',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Month.Default',
                'LanguageCode' => 'ENG',
                'value' => '--month--',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Month.Default',
                'LanguageCode' => 'CZK',
                'value' => '--měsíc--',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Or',
                'LanguageCode' => 'ENG',
                'value' => 'or',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Or',
                'LanguageCode' => 'CZK',
                'value' => 'nebo',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy',
                'LanguageCode' => 'ENG',
                'value' => 'Order by',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy',
                'LanguageCode' => 'CZK',
                'value' => 'Řadit podle',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.Asc',
                'LanguageCode' => 'ENG',
                'value' => 'Ascendant',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.Asc',
                'LanguageCode' => 'CZK',
                'value' => 'Vzestupně',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.Desc',
                'LanguageCode' => 'ENG',
                'value' => 'Descendant',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.Desc',
                'LanguageCode' => 'CZK',
                'value' => 'Sestupně',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemDate',
                'LanguageCode' => 'ENG',
                'value' => 'Date',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemDate',
                'LanguageCode' => 'CZK',
                'value' => 'Datum',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemName',
                'LanguageCode' => 'ENG',
                'value' => 'Name',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemName',
                'LanguageCode' => 'CZK',
                'value' => 'Název',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemPrice',
                'LanguageCode' => 'ENG',
                'value' => 'Price',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemPrice',
                'LanguageCode' => 'CZK',
                'value' => 'Cena',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Pattern',
                'LanguageCode' => 'ENG',
                'value' => 'pattern',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Pattern',
                'LanguageCode' => 'CZK',
                'value' => 'slovo',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.SetDefaultTitle',
                'LanguageCode' => 'ENG',
                'value' => 'default filtering',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.SetDefaultTitle',
                'LanguageCode' => 'CZK',
                'value' => 'výchozí filtrování',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Types.Default',
                'LanguageCode' => 'ENG',
                'value' => '- note -',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Types.Default',
                'LanguageCode' => 'CZK',
                'value' => '- druh útraty -',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Year',
                'LanguageCode' => 'ENG',
                'value' => 'year',
            ],
            [
                'TranslationCode' => 'Uvod.Filtering.Year',
                'LanguageCode' => 'CZK',
                'value' => 'rok',
            ],
            [
                'TranslationCode' => 'Uvod.Heading1',
                'LanguageCode' => 'ENG',
                'value' => 'charges :-)',
            ],
            [
                'TranslationCode' => 'Uvod.Heading1',
                'LanguageCode' => 'CZK',
                'value' => 'útrata :-)',
            ],
            [
                'TranslationCode' => 'Wallet.Add.CreateBtn',
                'LanguageCode' => 'ENG',
                'value' => 'Create',
            ],
            [
                'TranslationCode' => 'Wallet.Add.CreateBtn',
                'LanguageCode' => 'CZK',
                'value' => 'Vytvořit',
            ],
            [
                'TranslationCode' => 'Wallet.Add.Error.Empty',
                'LanguageCode' => 'ENG',
                'value' => 'Empty name',
            ],
            [
                'TranslationCode' => 'Wallet.Add.Error.Empty',
                'LanguageCode' => 'CZK',
                'value' => 'Nevyplněné jméno',
            ],
            [
                'TranslationCode' => 'Wallet.Add.Name',
                'LanguageCode' => 'ENG',
                'value' => 'Name:',
            ],
            [
                'TranslationCode' => 'Wallet.Add.Name',
                'LanguageCode' => 'CZK',
                'value' => 'Název:',
            ],
            [
                'TranslationCode' => 'Wallet.Add.Name.Placeholder',
                'LanguageCode' => 'ENG',
                'value' => 'name',
            ],
            [
                'TranslationCode' => 'Wallet.Add.Name.Placeholder',
                'LanguageCode' => 'CZK',
                'value' => 'název',
            ],
            [
                'TranslationCode' => 'Wallet.Add.Title',
                'LanguageCode' => 'ENG',
                'value' => 'Add new Wallet',
            ],
            [
                'TranslationCode' => 'Wallet.Add.Title',
                'LanguageCode' => 'CZK',
                'value' => 'Přidat novou peněženku',
            ],
            [
                'TranslationCode' => 'Wallet.Archive.H2',
                'LanguageCode' => 'ENG',
                'value' => 'Archive',
            ],
            [
                'TranslationCode' => 'Wallet.Archive.H2',
                'LanguageCode' => 'CZK',
                'value' => 'Archiv',
            ],
            [
                'TranslationCode' => 'Wallet.DeleteBtn.Title',
                'LanguageCode' => 'ENG',
                'value' => 'Delete wallet',
            ],
            [
                'TranslationCode' => 'Wallet.DeleteBtn.Title',
                'LanguageCode' => 'CZK',
                'value' => 'Smazat peněženku',
            ],
            [
                'TranslationCode' => 'Wallet.H2',
                'LanguageCode' => 'ENG',
                'value' => 'Expenses of wallet:',
            ],
            [
                'TranslationCode' => 'Wallet.H2',
                'LanguageCode' => 'CZK',
                'value' => 'Výdaje peněženky:',
            ],
            [
                'TranslationCode' => 'Wallet.H2.OldItems',
                'LanguageCode' => 'ENG',
                'value' => 'Archived expenses of wallet:',
            ],
            [
                'TranslationCode' => 'Wallet.H2.OldItems',
                'LanguageCode' => 'CZK',
                'value' => 'Archivované výdaje peněženky:',
            ],
            [
                'TranslationCode' => 'Wallet.Incomes.H2',
                'LanguageCode' => 'ENG',
                'value' => 'Incomes',
            ],
            [
                'TranslationCode' => 'Wallet.Incomes.H2',
                'LanguageCode' => 'CZK',
                'value' => 'Příjmy',
            ],
            [
                'TranslationCode' => 'Wallet.Preview.Card',
                'LanguageCode' => 'ENG',
                'value' => 'On card:',
            ],
            [
                'TranslationCode' => 'Wallet.Preview.Card',
                'LanguageCode' => 'CZK',
                'value' => 'Na kartě:',
            ],
            [
                'TranslationCode' => 'Wallet.Preview.Cash',
                'LanguageCode' => 'ENG',
                'value' => 'In cash:',
            ],
            [
                'TranslationCode' => 'Wallet.Preview.Cash',
                'LanguageCode' => 'CZK',
                'value' => 'V hotovosti:',
            ],
            [
                'TranslationCode' => 'Wallet.Preview.Items',
                'LanguageCode' => 'ENG',
                'value' => 'Items:',
            ],
            [
                'TranslationCode' => 'Wallet.Preview.Items',
                'LanguageCode' => 'CZK',
                'value' => 'Položek:',
            ],
            [
                'TranslationCode' => 'Wallet.Preview.PerMonth',
                'LanguageCode' => 'ENG',
                'value' => 'This month:',
            ],
            [
                'TranslationCode' => 'Wallet.Preview.PerMonth',
                'LanguageCode' => 'CZK',
                'value' => 'Tento měsíc:',
            ],
            [
                'TranslationCode' => 'Wallet.Update.CreateBtn',
                'LanguageCode' => 'ENG',
                'value' => 'Update',
            ],
            [
                'TranslationCode' => 'Wallet.Update.CreateBtn',
                'LanguageCode' => 'CZK',
                'value' => 'Upravit',
            ],
            [
                'TranslationCode' => 'Wallet.Update.Name',
                'LanguageCode' => 'ENG',
                'value' => 'Name',
            ],
            [
                'TranslationCode' => 'Wallet.Update.Name',
                'LanguageCode' => 'CZK',
                'value' => 'Název',
            ],
            [
                'TranslationCode' => 'Wallet.Update.Title',
                'LanguageCode' => 'ENG',
                'value' => 'Change wallet',
            ],
            [
                'TranslationCode' => 'Wallet.Update.Title',
                'LanguageCode' => 'CZK',
                'value' => 'Upravit peněženku',
            ],
            [
                'TranslationCode' => 'Wallet.UpdateBtn.Title',
                'LanguageCode' => 'ENG',
                'value' => 'Update wallet',
            ],
            [
                'TranslationCode' => 'Wallet.UpdateBtn.Title',
                'LanguageCode' => 'CZK',
                'value' => 'Modifikovat peněženku',
            ],
            [
                'TranslationCode' => 'Yes',
                'LanguageCode' => 'ENG',
                'value' => 'YES',
            ],
            [
                'TranslationCode' => 'Yes',
                'LanguageCode' => 'CZK',
                'value' => 'ANO',
            ],
        ];
    }
}

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
			'TranslationCode' => 'AddIncome.Error.Date.Empty',
			'value' => 'Nevyplněný datum',
			'LanguageCode' => 'CZK',
		]);
		/*
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Error.Name.Empty',
			'value' => 'Prázdný název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Error.Price.BadFormat',
			'value' => 'Cena ve špatném formátu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Error.Price.Empty',
			'value' => 'Prázdná cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.AnotherCurrency',
			'value' => 'jiná měna',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Currency',
			'value' => 'Měna:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.CurrencyCourse',
			'value' => 'kurz:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Date',
			'value' => 'Datum:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Heading',
			'value' => 'Nový příjem',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Name',
			'value' => 'Krátký popis:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Name.Placeholder',
			'value' => 'výplata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Price',
			'value' => 'Cena:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Save',
			'value' => 'Vytvořit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Type',
			'value' => 'Typ:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Type.Card',
			'value' => 'Na kartu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddIncome.Form.Type.Cash',
			'value' => 'V hotovosti',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Error.Course.Empty',
			'value' => 'Prázdný kurz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Error.Date.Empty',
			'value' => 'Prázdný datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Error.Name.Empty',
			'value' => 'Prázdné jméno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Error.Note.NoNote',
			'value' => 'Nevybrána poznámka. Nějakou si vyberte v nastavení.',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Error.Price.BadFormat',
			'value' => 'Špatná cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Error.Price.Empty',
			'value' => 'Prázdná cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.AnotherCurrency',
			'value' => 'jiná měna',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.BadName',
			'value' => 'Vyplň název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.BadPrice',
			'value' => 'Vyplň cenu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Currency',
			'value' => 'Měna:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.CurrencyCourse',
			'value' => 'kurz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Date',
			'value' => 'Datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Description',
			'value' => 'Popis',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Description.Placeholder',
			'value' => 'popis',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Duplicity',
			'value' => 'Záznam již existuje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Heading',
			'value' => 'Přidat novou položku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.MyExpense',
			'value' => 'ODEPSAT',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Name',
			'value' => 'Název',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Name.Placeholder',
			'value' => 'n�zev',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Note',
			'value' => 'Pozn�mka',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Pick',
			'value' => 'VYBRAT',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Price',
			'value' => 'Cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.RequiredField',
			'value' => 'Povinn� pole',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Save',
			'value' => 'Nahr�t',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Success',
			'value' => 'Polo�ka byla nahr�na do datab�ze',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.SuccessButton',
			'value' => 'P?idat dal�� polo�ku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Type',
			'value' => 'Typ platby',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Type.Card',
			'value' => 'Karta',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddItem.Form.Type.Cash',
			'value' => 'Hotovost',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.AddAnotherItem',
			'value' => 'P?idal tal�� polo�ku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.AddedText',
			'value' => 'Transakce prob?hla �sp?n?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.BadPrice',
			'value' => 'Vypl? cenu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.BadReason',
			'value' => 'Vypl? d?vod',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.Price',
			'value' => 'V?novat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.PriceNaN',
			'value' => 'Cena nen� ?�slo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.Reason',
			'value' => 'D?vod',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.Reason.Default',
			'value' => 'Max 60 zank?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.ReasonBadLength',
			'value' => 'D?vod m?�e m�t nejv�e {%d} znak?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.Send',
			'value' => 'Nahr�t',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.Type',
			'value' => 'Na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.Type.Card',
			'value' => 'Kartu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.Type.Cash',
			'value' => 'V hotovosti',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Form.UseDelimiter',
			'value' => 'Pro odd?len� hal�?? pou�ij desetinnou te?ku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Heading1',
			'value' => 'P?idat ?�stku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.SuccessMail.Message1',
			'value' => 'Bylo p?ips�no',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.SuccessMail.Message2',
			'value' => 'V?c',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.SuccessMail.Subject',
			'value' => 'Transakce na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Table.Date',
			'value' => 'Datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Table.Delete',
			'value' => 'Smazat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Table.Delete.Title',
			'value' => 'Smazat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Table.ID',
			'value' => 'ID',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Table.Reason',
			'value' => 'D?vod',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Table.Type',
			'value' => 'Typ',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'AddTransaction.Table.Value',
			'value' => 'Hodnota',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Dashboard.AddWallet',
			'value' => 'P?idat pen?�enku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Error.LoginAgain',
			'value' => 'P?ihla�te se znova',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Error.LogInFirst',
			'value' => 'Nejd?�v se p?ihla�te',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Facebook.Error.AllowEmail',
			'value' => 'Mus�te si na Facebooku povolit p?�stup k emailu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Facebook.Error.AllowLocale',
			'value' => 'Mus�te si na Facebooku povolit sv� �daje o poloze a st�tu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Facebook.Error.AllowName',
			'value' => 'Mus�te si nejprve povolit p?�stup ke jm�nu na facebooku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Import.Description',
			'value' => 'Vlo�te soubor CSV, kter� jste si d?�ve st�hl(a)',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Import.Send',
			'value' => 'Nahr�t',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Import.Title',
			'value' => 'Nahr�t z�lohu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Incomes.H2',
			'value' => 'P?�jmy pen?�enky:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Item.Form.Required',
			'value' => 'Povinn� polo�ky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Items.Loading.Alt',
			'value' => 'Na?�t�n�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Admin',
			'value' => 'administr�tor',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.BadInput',
			'value' => '�patn� p?ihla�ovac� �daje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Mail.Message.Login',
			'value' => 'Login',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Mail.Message.Password',
			'value' => 'heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Mail.Subject.AppName',
			'value' => '�trata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Mail.Subject.Specification',
			'value' => 'zapomenut� �daje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Headding1',
			'value' => 'Zapomenut� �daje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Mail',
			'value' => 'V� e-mail',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Send',
			'value' => 'Odeslat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.EmptyMail',
			'value' => 'Vypl? mail',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.Error',
			'value' => 'N?co se pokazilo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.MailNotSent',
			'value' => 'Email se nepoda?ilo odeslat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.MorePeopleWithSameMail',
			'value' => 'V�ce lid� m� stejn� mail. Kontaktujte spr�vce webu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.Nobody',
			'value' => 'Nikdo s takov�m mailem nen� v datab�zi veden',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.SQLStatementError',
			'value' => '�pan� SQL p?�kaz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Forgotten.Modal.Status.Success',
			'value' => 'P?ihla�ovac� �daje V�m byly zasl�ny na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.ForgottenPassword',
			'value' => 'Zapomenut� p?ihla�ovac� �daje',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Login',
			'value' => 'Jm�no',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.LogInto',
			'value' => 'P?ihl�sit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.Password',
			'value' => 'Heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Login.SignIn',
			'value' => 'Registrovat se',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'MailEngine.FailToSend',
			'value' => 'E-mail se nepoda?ilo odeslat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.AddItem',
			'value' => 'P?idat polo�ku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Back',
			'value' => 'Zp?t',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.DownloadBackUp',
			'value' => 'St�hnout z�lohu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Home',
			'value' => 'Dom?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Incomes',
			'value' => 'P?�jmy',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.LoadImport',
			'value' => 'Nahr�t data',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Logout',
			'value' => 'Odhl�sit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.MothlyPreview',
			'value' => 'M?s�?n� p?ehled',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.OldItems',
			'value' => 'Star� �?ty',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Settings',
			'value' => 'Nastaven�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.Shortcuts',
			'value' => 'kl�vesov� zkratky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Menu.ShortcutsTitle',
			'value' => 'Ctrl+, - nov� z�znam
Ctrl+M - nov� transakce
Ctrl+O - star� z�znamy
Ctrl+S - nastaven�
Ctrl+Z - zp?t v historii
Ctrl+Y - vp?ed v historii
Ctrl+B - zp?t na hlavn�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.April',
			'value' => 'Duben',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.August',
			'value' => 'Srpen',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.December',
			'value' => 'Prosinec',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.February',
			'value' => '�nor',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.January',
			'value' => 'Leden',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.July',
			'value' => '?ervenec',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.June',
			'value' => '?erven',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.March',
			'value' => 'B?ezen',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.May',
			'value' => 'Kv?ten',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.November',
			'value' => 'Listopad',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.October',
			'value' => '?�jen',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Month.September',
			'value' => 'Z�?�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'No',
			'value' => 'NE',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'OldItems.Heading1',
			'value' => 'Ji� zapsan� �?ty',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.CheckedItemTitle',
			'value' => 'Check',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.DeleteItemTitle',
			'value' => 'Smazat z�znam',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Description',
			'value' => 'Bli��� popis',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Filtering.Error.TwoSpaces',
			'value' => '?et?zec za?�nal dv?ma mezarama!',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.More.Button',
			'value' => 'Dal��ch',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Name',
			'value' => 'N�zev polo�ky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.NoResults',
			'value' => 'Takov�mu v�b?ru neodpov�daj� ��dn� v�sledky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Note',
			'value' => 'Pozn�mka',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.PayedBy.Card',
			'value' => 'karta',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.PayedBy.Cash',
			'value' => 'hotovost',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Price',
			'value' => 'Celkov� cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.TotalItemsPrice',
			'value' => 'SUM:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.TotalItemsSize',
			'value' => 'Celkem polo�ek:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.Type',
			'value' => 'Placeno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'PrintItems.UpdateItemTitle',
			'value' => 'Aktualizovat polo�ku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Button',
			'value' => 'N�hled e-mailu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.For',
			'value' => 'Za',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.FromMonth',
			'value' => 'Vy�?tov�n� za',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.FromYear',
			'value' => 'roku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.Intro',
			'value' => 'Text zpr�vy',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.Items',
			'value' => 'polo�ek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.ItemsCount',
			'value' => 'Po?et polo�ek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Preview.Send',
			'value' => 'Opravdu poslat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Sent.ToDate',
			'value' => '�?etnictv� za',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Sent.ToMail',
			'value' => 'odesl�no na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'SendToParent.Year',
			'value' => 'rok',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.Login',
			'value' => '�patn? vypln?n� login',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.MailToParent',
			'value' => '�patn? vypln?n� mail na rodi?e',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.Name',
			'value' => '�patn? vypln?n� jm�no',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.Password',
			'value' => '�patn? vypln?n� heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Alert.PasswordAgain',
			'value' => '�patn? vypln?n� heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Change',
			'value' => 'Zm?nit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ChangePassword.CheckBox',
			'value' => 'Zm?nit heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ConfirmPassword',
			'value' => 'Potvrzen� heslo:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ConfirmPassword.NotSame',
			'value' => 'hesla se neshoduj�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.ConfirmPassword.Placeholder',
			'value' => 'heslo znova',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Currency',
			'value' => 'M?na:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.FirstName',
			'value' => 'Jm�no:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.FirstName.Empty',
			'value' => 'Pr�zdn� jm�no',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.FirstName.Placeholder',
			'value' => 'Jan',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Form.MyMail.Empty',
			'value' => 'Pr�zdn� e-mailov� adresa',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.KindOfSpend.AddNew',
			'value' => 'P?idat',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.KindsOfSpend',
			'value' => 'Druhy �traty:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Language',
			'value' => 'Jazyk:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.LastName',
			'value' => 'P?�jmen�:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.LastName.Empty',
			'value' => 'Pr�zdn� p?�jmen�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.LastName.Placeholder',
			'value' => 'Nov�k',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login',
			'value' => 'Login:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login.AlreadyExists',
			'value' => 'Tato hodnota je ji� zabran�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login.SomeError',
			'value' => 'N?jak� chyba',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Login.TooShort',
			'value' => 'p?�li� kr�tk� (< {%d} znak?)',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Mail.BadFormat',
			'value' => '�patn� form�t',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.MailToMe',
			'value' => 'Mail na m?:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.MailToParent',
			'value' => 'Mail na rodi?e:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.NoteAdd.Empty',
			'value' => 'Pr�zdn� druh �traty',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.OldPassword',
			'value' => 'Nyn?j�� heslo:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.OldPassword.Placeholder',
			'value' => 'heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password',
			'value' => 'Zm?na hesla:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password.BadSecurity',
			'value' => 'Alespo? 2 vlastnosti z [a-z], [A-Z] a [0-9]',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password.Placeholder',
			'value' => 'heslo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Password.TooShort',
			'value' => 'p?�li� kr�tk� (< {%d} znak?)',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Result.Error',
			'value' => 'N?co se pokazilo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.Result.Success',
			'value' => 'V�e zm?n?no',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.SendByOne',
			'value' => 'Pos�lat rodi?i ka�dou polo�ku:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Form.SendMonthly',
			'value' => 'Mo�nost pos�lat m?s�?n� v�pis:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Settings.Heading',
			'value' => 'nastaven�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ShowItems.CheckAll.Alert',
			'value' => 'Chce� checknout v�echny tyto polo�ky?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ShowItems.CheckAll.Title',
			'value' => 'Check v�echny zobrazen�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'ShowItems.Delete.Alert',
			'value' => 'Opravdu chce� smazat?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.Description',
			'value' => 'Zde se m?�ete pod�vat na statistiku, jak na tom tento m?s�c jste vzhledem k p?ede�l�m m?s�c?m. Vybrat si m?�ete, jestli chcete p?ehled konkr�tn� pozn�mky, ?i v�eho.',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.Filtering.NotesLabel',
			'value' => 'Statistika pro ur?itou pozn�mku:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.Filtering.Types.Default',
			'value' => '--pozn�mka--',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Average',
			'value' => 'PR?M?RN?:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Date',
			'value' => 'M?s�c',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Max',
			'value' => 'MAX:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Min',
			'value' => 'MIN:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Percentage',
			'value' => 'Procento:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.ThisMonth',
			'value' => 'Tento m?s�c',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.Extremes.Value',
			'value' => '�trata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.FullMonth.H2',
			'value' => 'Srovn�n� s cel�mi m?s�ci',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.H1',
			'value' => 'M?s�?n� p?ehled pen?�enky:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Average',
			'value' => 'PR?M?R:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Date',
			'value' => 'M?s�c',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Max',
			'value' => 'MAX:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Min',
			'value' => 'MIN:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Percentage',
			'value' => 'Procento',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.ThisMonth',
			'value' => 'Tento m?s�c',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.Extremes.Value',
			'value' => '�trata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.PartMonth.H2',
			'value' => 'Srovn�n� s m?s�ci do {%d}. ka�d�ho m?s�ce',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.Expense',
			'value' => '�trata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.ExpensesCnt',
			'value' => 'polo�ek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.Income',
			'value' => 'P?�jem',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.IncomesCnt',
			'value' => 'polo�ek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.Percentage',
			'value' => 'Procento',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.Season',
			'value' => 'M?s�c',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TableFull.Head.ThisMonth',
			'value' => '�trata tohoto m?s�ce',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TablePart.Head.Expense',
			'value' => '�trata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TablePart.Head.ExpensesCnt',
			'value' => 'polo�ek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TablePart.Head.Income',
			'value' => 'P?�jem',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TablePart.Head.IncomesCnt',
			'value' => 'polo�ek',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TablePart.Head.Percentage',
			'value' => 'Procento',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TablePart.Head.Season',
			'value' => 'M?s�c',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Statistics.TablePart.Head.ThisMonth',
			'value' => '�trata tohoto m?s�ce',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Status.Card',
			'value' => 'Z?statek na kart?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Status.Cash',
			'value' => 'Z?statek v hotovosti',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Title',
			'value' => ' - �trata',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Course.Empty',
			'value' => 'Pr�zdn� kurz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Date.Empty',
			'value' => 'Nevypln?n� datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Name.Empty',
			'value' => 'Pr�zdn� n�zev',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Price.BadFormat',
			'value' => 'Cena ve �patn�m form�tu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Error.Price.Empty',
			'value' => 'Pr�zdn� cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.AnotherCurrency',
			'value' => 'jin� m?na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Currency',
			'value' => 'M?na:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.CurrencyCourse',
			'value' => 'kurz:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Date',
			'value' => 'Datum:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Heading',
			'value' => 'Upravit p?�jem',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Name',
			'value' => 'Kr�tk� popis:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Price',
			'value' => 'Cena:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Save',
			'value' => 'Vytvo?it',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Type',
			'value' => 'Typ:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Type.Card',
			'value' => 'Na kartu',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Type.Cash',
			'value' => 'V hotovosti',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateIncome.Form.Wallet',
			'value' => 'Pen?�enka:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.AlreadyUpdating',
			'value' => 'Ji� se aktualizuje polo�ka',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Course.Empty',
			'value' => 'Pr�zdn� kurz',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Date.Empty',
			'value' => 'Pr�zdn� datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Name.Empty',
			'value' => 'Pr�zdn� jm�no',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Price.BadFormat',
			'value' => '�patn� cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Error.Price.Empty',
			'value' => 'Pr�zdn� cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.AnotherCurrency',
			'value' => 'jin� m?na',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Course',
			'value' => 'kurz:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Currency',
			'value' => 'M?na:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Date',
			'value' => 'Datum:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Description',
			'value' => 'Popis:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Heading',
			'value' => '�prava polo�ky',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Name',
			'value' => 'N�zev:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Odepsat',
			'value' => 'Odepsat:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Price',
			'value' => 'Cena:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Purpose',
			'value' => 'Pozn�mka:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Save',
			'value' => 'Upravit',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Type',
			'value' => 'Typ:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Type.Card',
			'value' => 'Karta',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Type.Cash',
			'value' => 'Hotovost',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Form.Wallet',
			'value' => 'Pen?�enka:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Storno',
			'value' => 'Storno',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'UpdateItem.Update',
			'value' => 'Ulo�it',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Error.Again',
			'value' => 'Chyba p?i na?�t�n� souboru. Zkuste to pros�m pozd?ji',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Error.NoCSV',
			'value' => 'Soubor nen� typu CSV',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Error.NoFile',
			'value' => 'Vyberte n?jak� soubor',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Success',
			'value' => 'Soubor nahr�n',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uploading.Upload.Button',
			'value' => 'Vybrat soubor',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.DownloadBackUp.ErrorOcured',
			'value' => 'Vyskytla se chyba',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.AndMonth',
			'value' => 'a vybrat pouze',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.HelpTitle',
			'value' => 'jednotliv� ?et?zce odd?lujte dv?ma mezerama
pro naps�n� dvou mezer napi�t? \'\\ \\ \'
\'!\' p?ed ?et?zcem - ?et?zec, kter� se v polo�ce nikde nevyskytuje
pro naps�n� vyk?i?n�ku pou�ijte v�raz \'\\',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Month.Default',
			'value' => '--m?s�c--',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Or',
			'value' => 'nebo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy',
			'value' => '?adit podle',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.Asc',
			'value' => 'Vzestupn?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.Desc',
			'value' => 'Sestupn?',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemDate',
			'value' => 'Datum',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemName',
			'value' => 'N�zev',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.OrderBy.ItemPrice',
			'value' => 'Cena',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Pattern',
			'value' => 'slovo',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.SetDefaultTitle',
			'value' => 'v�choz� filtrov�n�',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Types.Default',
			'value' => '- pozn�mka -',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Filtering.Year',
			'value' => 'rok',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Uvod.Heading1',
			'value' => '�trata :-)',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.CreateBtn',
			'value' => 'Vytvo?it',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Error.Empty',
			'value' => 'Pr�zdn� jm�no',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Name',
			'value' => 'N�zev:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Name.Placeholder',
			'value' => 'n�zev',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Add.Title',
			'value' => 'P?idat novou pen?�enku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.DeleteBtn.Title',
			'value' => 'Smazat pen?�enku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.H2',
			'value' => 'V�daje pen?�enky:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.H2.OldItems',
			'value' => 'Zkontrolovan� v�daje pen?�enky:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.Card',
			'value' => 'Na kart?:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.Cash',
			'value' => 'V hotovosti:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.Items',
			'value' => 'Polo�ek:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.Preview.PerMonth',
			'value' => 'Tento m?s�c:',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Wallet.UpdateBtn.Title',
			'value' => 'Modifikovat pen?�enku',
			'LanguageCode' => 'CZK',
		]);
		DB::table('utrata_translations')->insert([
			'TranslationCode' => 'Yes',
			'value' => 'ANO',
			'LanguageCode' => 'CZK',
		]);
		*/
	}
}
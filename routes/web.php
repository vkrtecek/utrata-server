<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
	return view('welcome');
});*/


/*##################-  Member  -######################*/
//Route::get('/members', 'MemberController@gets');
Route::get('/member', 'MemberController@get');
Route::get('/member/login/exists/{login}', 'MemberController@checkLoginExistence');
Route::get('/member/email/exists/{email}', 'MemberController@checkEmailExistence');
Route::post('/member', 'MemberController@create');
Route::post('/member/login', 'MemberController@login');
Route::post('/member/logout', 'MemberController@logout');
Route::post('/member/facebook', 'MemberController@interactWithFacebook');
Route::put('/member', 'MemberController@update');
//Route::delete('/member', 'MemberController@delete');


/*##################-  Language  -######################*/
Route::get('/languages', 'LanguageController@gets');
//Route::get('/language', 'LanguageController@get');
//Route::post('/language', 'LanguageController@create');
//Route::put('/language', 'LanguageController@update');
//Route::delete('/language', 'LanguageController@delete');


/*##################-  Currency  -######################*/
Route::get('/currencies', 'CurrencyController@gets');
//Route::get('/currency', 'CurrencyController@get');
//Route::post('/currency', 'CurrencyController@create');
//Route::put('/currency', 'CurrencyController@update');
//Route::delete('/currency', 'CurrencyController@delete');



/*##################-  Item  -######################*/
Route::get('/items/wallet/{walletId}', 'ItemController@getWalletItems');
Route::get('/items/statistics', 'ItemController@statistics');
//Route::get('/item', 'ItemController@get');
Route::post('/item', 'ItemController@create');
Route::put('/item', 'ItemController@update');
Route::put('/item/check/{id}', 'ItemController@check');
Route::put('/items/check', 'ItemController@checkAll');
Route::delete('/item/{id}', 'ItemController@delete');

/*##################-  CheckState  -######################*/
//Route::get('/checkStates', 'CheckStateController@gets');
//Route::get('/checkState', 'CheckStateController@get');
//Route::post('/checkState', 'CheckStateController@create');
//Route::put('/checkState', 'CheckStateController@update');
//Route::delete('/checkState', 'CheckStateController@delete');



/*##################-  Note  -######################*/
Route::get('/purposes', 'PurposeController@getUserPurposes');
Route::get('/purposes/language/{code}', 'PurposeController@getLanguagePurposes');
Route::get('/purposesOfUser', 'PurposeController@getPurposesCreatedByUser');
Route::get('/purposes/allAvailable', 'PurposeController@getPurposesAvailableForUser');
//Route::get('/purpose', 'PurposeController@get');
Route::post('/purpose', 'PurposeController@create');
//Route::put('/purpose', 'PurposeController@update');
Route::delete('/purpose/{id}', 'PurposeController@delete');


/*##################-  Translation  -######################*/
Route::get('/translations', 'TranslationController@gets');
//Route::get('/translation', 'TranslationController@get');
//Route::post('/translation', 'TranslationController@create');
//Route::put('/translation', 'TranslationController@update');
//Route::delete('/translation', 'TranslationController@delete');


/*##################-  Wallet  -######################*/
Route::get('/wallets', 'WalletController@getUserWallets');
Route::get('/wallet/{id}', 'WalletController@get');
Route::post('/wallet', 'WalletController@create');
Route::put('/wallet/checkState/{walletId}', 'WalletController@updateCheckState');
Route::put('/wallet/{id}', 'WalletController@update');
Route::delete('/wallet/{id}', 'WalletController@delete');


/*###################-  File  -#######################*/
Route::get('/file/backup', 'FileController@backup');
Route::post('/file/import', 'FileController@store');


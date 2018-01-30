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
//Route::get('/member/{id}', 'MemberController@get');
//Route::post('/member', 'MemberController@create');
Route::post('/member/login', 'MemberController@login');
Route::post('/member/logout', 'MemberController@logout');
//Route::post('/member/facebook', 'MemberController@interactWithFacebook');
//Route::put('/member', 'MemberController@update');
//Route::delete('/member', 'MemberController@delete');


/*##################-  Language  -######################*/
//Route::get('/languages', 'LanguageController@gets');
//Route::get('/language', 'LanguageController@get');
//Route::post('/language', 'LanguageController@create');
//Route::put('/language', 'LanguageController@update');
//Route::delete('/language', 'LanguageController@delete');


/*##################-  Currency  -######################*/
//Route::get('/currencies', 'CurrencyController@gets');
//Route::get('/currency', 'CurrencyController@get');
//Route::post('/currency', 'CurrencyController@create');
//Route::put('/currency', 'CurrencyController@update');
//Route::delete('/currency', 'CurrencyController@delete');



/*##################-  Item  -######################*/
Route::get('/items/wallet/{walletId}', 'ItemController@getWalletItems');
Route::get('/item', 'ItemController@get');
Route::post('/item', 'ItemController@create');
//Route::put('/item', 'ItemController@delete');
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
//Route::get('/purpose', 'PurposeController@get');
//Route::post('/purpose', 'PurposeController@create');
//Route::put('/purpose', 'PurposeController@update');
//Route::delete('/purpose', 'PurposeController@delete');


/*##################-  Translation  -######################*/
Route::get('/translations', 'TranslationController@gets');
//Route::get('/translation', 'TranslationController@get');
//Route::post('/translation', 'TranslationController@create');
//Route::put('/translation', 'TranslationController@update');
//Route::delete('/translation', 'TranslationController@delete');


/*##################-  Wallet  -######################*/
Route::get('/wallets', 'WalletController@getUserWallets');
Route::get('/wallet', 'WalletController@get');
Route::post('/wallet', 'WalletController@create');
Route::put('/wallet/{id}', 'WalletController@update');
Route::delete('/wallet/{id}', 'WalletController@delete');


/*###################-  File  -#######################*/
Route::get('/member/backup', 'FileController@backup');
//Route::post('/member/import', 'FileController@store');
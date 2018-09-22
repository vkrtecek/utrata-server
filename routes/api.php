<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



/*##################-  Member  -######################*/
Route::middleware('auth:api')->get('member', 'MemberController@get');
Route::get('member/login/exists/{login}', 'MemberController@checkLoginExistence')->where('login', '[a-zA-Z0-9]+');
Route::get('member/email/exists/{email}', 'MemberController@checkEmailExistence')->where('email', '[a-zA-Z0-9]+');
Route::post('member', 'MemberController@create');
Route::post('member/login', 'MemberController@login');
Route::post('member/logout', 'MemberController@logout');
Route::post('member/facebook', 'MemberController@interactWithFacebook');
Route::put('member', 'MemberController@update');


/*##################-  Language  -######################*/
Route::get('languages', 'LanguageController@gets');


/*##################-  Currency  -######################*/
Route::get('currencies', 'CurrencyController@gets');


/*##################-  Item  -######################*/
Route::get('items/wallet/{walletId}', 'ItemController@getWalletItems');
Route::get('items/statistics', 'ItemController@statistics');
Route::post('item', 'ItemController@create');
Route::put('item', 'ItemController@update');
Route::put('item/check/{id}', 'ItemController@check');
Route::put('items/check', 'ItemController@checkAll');
Route::delete('item/{id}', 'ItemController@delete');


/*##################-  Note  -######################*/
Route::get('purposes', 'PurposeController@getUserPurposes');
Route::get('purposes/language/{code}', 'PurposeController@getLanguagePurposes')->where('code', '[a-zA-Z0-9]+');
Route::get('purposesOfUser', 'PurposeController@getPurposesCreatedByUser');
//	Route::get('purposes/allAvailable', 'PurposeController@getPurposesAvailableForUser');
Route::post('purpose', 'PurposeController@create');
Route::delete('purpose/{id}', 'PurposeController@delete');


/*##################-  MemberPurpose  -###################*/


/*##################-  Translation  -######################*/
Route::get('translations', 'TranslationController@gets');


/*##################-  Wallet  -######################*/
Route::get('wallets', 'WalletController@getUserWallets');
Route::get('wallet/{id}', 'WalletController@get');
Route::post('wallet', 'WalletController@create');
Route::put('wallet/checkState/{walletId}', 'WalletController@updateCheckState');
Route::put('wallet/{id}', 'WalletController@update');
Route::delete('wallet/{id}', 'WalletController@delete');


/*###################-  File  -#######################*/
Route::get('file/backup', 'FileController@backup');
Route::post('file/import', 'FileController@store');

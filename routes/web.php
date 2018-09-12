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

Route::get('/', function(){ return redirect(route('get.wallets')); });

/*##################-  Member  -######################*/
Route::get('member', 'MemberControllerMVC@get')->name('get.member');
Route::get('member/login/exists/{login}', 'MemberControllerMVC@checkLoginExistence')->name('get.member.login.exists');
Route::get('member/email/exists/{email}', 'MemberControllerMVC@checkEmailExistence')->name('get.member.email.exists');
Route::get('member/settings', 'MemberControllerMVC@settings')->name('get.member.settings');
Route::post('member', 'MemberControllerMVC@create')->name('post.member');
Route::post('member/facebook', 'MemberControllerMVC@interactWithFacebook')->name('post.member.facebook');
Route::put('member', 'MemberControllerMVC@update')->name('put.member');


/*##################-  Item  -######################*/
Route::get('/item/{itemId}', 'ItemControllerMVC@getHTML')->name('get.item.HTML');
Route::get('/items/wallet/{walletId}', 'ItemControllerMVC@getWalletItems')->name('get.items.wallet');
Route::get('/wallet/{id}/addItem', 'ItemControllerMVC@create')->name('get.item.addItem');
Route::get('/wallet/{id}/addIncome', 'ItemControllerMVC@createIncome')->name('get.item.addIncome');
Route::get('/item/update/{itemId}', 'ItemControllerMVC@update')->name('get.item.update');
//Route::get('/items/statistics', 'ItemControllerMVC@statistics')->name('get.items.statistics');
Route::post('/wallet/{id}/item', 'ItemControllerMVC@create')->name('post.item');
Route::post('/wallet/{id}/income', 'ItemControllerMVC@createIncome')->name('post.item.income');
Route::put('/item/{id}', 'ItemControllerMVC@update')->name('put.item');
Route::put('/item/check/{id}', 'ItemControllerMVC@check')->name('put.item.check');
Route::put('/items/check/{walletId}', 'ItemControllerMVC@checkAll')->name('put.items.check');
Route::delete('/item/{id}', 'ItemControllerMVC@delete')->name('delete.item');


/*##################-  Note  -######################*/
//Route::get('/purposes', 'PurposeControllerMVC@getUserPurposes')->name('get.purposes');
//Route::get('/purposes/language/{code}', 'PurposeControllerMVC@getLanguagePurposes')->name('get.languagePurposes');
//Route::get('/purposesOfUser', 'PurposeControllerMVC@getPurposesCreatedByUser')->name('get.userPurposes');
//Route::get('/purposes/allAvailable', 'PurposeControllerMVC@getPurposesAvailableForUser')->name('get.purposes.available');
Route::get('/purposes/manage', 'PurposeControllerMVC@manage')->name('get.purposes.manage');
Route::post('/purpose', 'PurposeControllerMVC@create')->name('post.purpose');
Route::delete('/purpose/{id}', 'PurposeControllerMVC@delete')->name('delete.purpose');


/*##################-  MemberPurpose  -###################*/
Route::post('/member_purpose', 'MemberPurposeControllerMVC@create')->name('post.memberPurpose.connection');
Route::delete('/member_purpose', 'MemberPurposeControllerMVC@delete')->name('delete.memberPurpose.connection');



/*##################-  Wallet  -######################*/
Route::get('/home', 'WalletControllerMVC@getUserWallets')->name('get.wallets');
Route::get('/wallet/add', 'WalletControllerMVC@create')->name('get.wallet.add');
Route::get('/wallet/update/{id}', 'WalletControllerMVC@update')->name('get.wallet.update');
Route::get('/wallet/{id}', 'WalletControllerMVC@get')->name('get.wallet');
Route::get('wallet/{id}/incomes', 'WalletControllerMVC@incomes')->name('get.wallet.incomes');
Route::get('wallet/{id}/archive', 'WalletControllerMVC@archive')->name('get.wallet.archive');
Route::get('/wallet/{id}/checkState', 'WalletControllerMVC@checkStateStatus')->name('get.checkstate.status');
Route::post('/wallet', 'WalletControllerMVC@create')->name('post.wallet');
Route::put('/wallet/{id}/checkState', 'WalletControllerMVC@updateCheckState')->name('put.wallet.checkState');
Route::put('/wallet/{id}', 'WalletControllerMVC@update')->name('put.wallet');
Route::delete('/wallet/{id}', 'WalletControllerMVC@delete')->name('delete.wallet');


/*###################-  File  -#######################*/
Route::get('/file/backup', 'FileControllerMVC@backup')->name('get.backup');
Route::get('/file/import', 'FileControllerMVC@store')->name('get.import');
Route::post('/file/import', 'FileControllerMVC@store')->name('post.import');


/*###################-  Additional  -#######################*/
Route::get('/course', 'CourseControllerMVC@get')->name('get.course');

Auth::routes();










/*
 * Routes with prefix API for JSONs transfer (Server-Client architecture)
 */
Route::prefix('api')->group(function(){

	/*##################-  Member  -######################*/
	Route::get('member', 'MemberController@get');
	Route::get('member/login/exists/{login}', 'MemberController@checkLoginExistence');
	Route::get('member/email/exists/{email}', 'MemberController@checkEmailExistence');
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
	Route::get('purposes/language/{code}', 'PurposeController@getLanguagePurposes');
	Route::get('purposesOfUser', 'PurposeController@getPurposesCreatedByUser');
	Route::get('purposes/allAvailable', 'PurposeController@getPurposesAvailableForUser');
	Route::post('purpose', 'PurposeController@create');
	Route::delete('purpose/{id}', 'PurposeController@delete');


	/*##################-  MemberPurpose  -###################*/
	Route::post('memberpurposes', 'MemberPurposeController@changePurposes');


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
});

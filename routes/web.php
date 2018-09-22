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
Route::get('member/login/exists/{login}', 'MemberControllerMVC@checkLoginExistence')->where('login', '[a-zA-Z0-9]+')->name('get.member.login.exists');
Route::get('member/email/exists/{email}', 'MemberControllerMVC@checkEmailExistence')->where('email', '[a-zA-Z0-9]+')->name('get.member.email.exists');
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
//Route::get('/purposes/language/{code}', 'PurposeControllerMVC@getLanguagePurposes')->where('code', '[a-zA-Z0-9]+')->name('get.languagePurposes');
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
Route::get('/wallet/{id}/monthlyPreview', 'WalletControllerMVC@monthlyPreview')->name('get.monthlyPreview');
Route::get('/wallet/{id}/monthlyPreviewData', 'WalletControllerMVC@monthlyPreviewData')->name('get.monthlyPreviewData');
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

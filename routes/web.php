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

Route::get('/', function () {
	return view('welcome');
});

Route::get('/wallets', 'WalletController@index');







Route::get('/item/{walletId}', 'ItemController@getWalletItems');
Route::post('/item', 'ItemController@createItem');
Route::put('/item', 'ItemController@delete');
Route::delete('/item', 'ItemController@getWalletItems');

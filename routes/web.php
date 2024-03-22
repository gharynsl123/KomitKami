<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

// User Route
Route::post('/store-user', 'UserController@store');
Route::get('/create-user', 'UserController@create');
Route::get('/edit-profile/{id}', 'UserController@editProfile');
Route::get('/edit-user/{id}', 'UserController@edit');
Route::put('/update-user/{id}', 'UserController@update');
Route::get('/user-configuration', 'UserController@index');
Route::get('/profile-user', 'UserController@profile');

// Dashboar Route
Route::get('/', 'HomeController@index');
Route::get('/dashboard', 'HomeController@index');
Route::get('/fetch-data', 'HomeController@fetchData')->name('fetch-data');


// Transaction Route
Route::get('/transaction', 'TransactionController@index');
Route::get('/buat-pesanan-restok', 'TransactionController@create');
Route::post('/store-transaction', 'TransactionController@store');

// Ordering Route
Route::get('/view-order', 'OrderController@index');
Route::get('/buat-order', 'OrderController@create');
Route::post('/store-order', 'OrderController@store');
Route::post('/revisi-order', 'OrderController@kirimRevisi');
Route::put('/reject-order/{id}', 'OrderController@reject');
Route::put('/accept-order/{id}', 'OrderController@accept');
Route::put('/change-time/{id}', 'OrderController@changetime');
Route::get('/order-details/{slug}', 'OrderController@detail');

// Inventory Route
Route::get('/local-inventory', 'InventoryController@index');
Route::get('/buat-bahan-baku', 'InventoryController@create');
Route::post('/store-bahanbaku', 'InventoryController@store');


// PO
Route::get('/catatan-po', 'OrderController@rekapPO')->name('rekap.po');
Route::get('/payment-pre-order', 'OrderController@unpaid');

// Produksi Route
Route::get('/ruang-produksi', 'ProduksiController@index');

// Products Route
Route::get('/products', 'ProductController@index');
Route::get('/create-products', 'ProductController@create');
Route::get('/edit-products/{id}', 'ProductController@edit');
Route::post('/store-products', 'ProductController@store');
Route::put('/update-product/{id}', 'ProductController@update');

// Customer Route
Route::get('/customer', 'InstansiController@index');
Route::get('/create-customer', 'InstansiController@create');
Route::post('/store-customer', 'InstansiController@store');

// Merek Route
Route::get('/merek', 'MerekController@index');
Route::post('/store-merek', 'MerekController@store');
Route::get('/edit-merek/{id}', 'MerekController@edit')->name('edit-merek');
Route::put('/update-merek/{id}', 'MerekController@update')->name('update-merek');

// Formula
Route::get('/formula', 'FormulaController@index');
Route::get('/buat-formula-baru', 'FormulaController@create');
Route::get('/detail-formula/{slug}', 'FormulaController@detail')->name('formula.detail');
Route::post('/store-formula', 'FormulaController@store');

// Archive
Route::get('/archive', 'ArchiveController@index');

// Laporan Route
Route::get('/laporan-pesanan/{slug}', 'LaporanController@view');
Route::PUT('/confirm-laporan/{id}', 'LaporanController@confirm');
Route::get('/confirm-revisi/order/{slug}', 'LaporanController@confirmRevision');
Route::put('/orders/{id}', 'LaporanController@updateConfirmation')->name('orders.update');


// chat Route
Route::get('/message', 'ChatController@index');

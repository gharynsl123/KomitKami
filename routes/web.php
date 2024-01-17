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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

// User Route
Route::post('/store-user', 'UserController@store');
Route::get('/create-user', 'UserController@create');
Route::get('/edit-user/{id}', 'UserController@edit');
Route::put('/update-user/{id}', 'UserController@update');
Route::get('/user-configuration', 'UserController@index');
Route::get('/profile-user', 'UserController@profile');

// Dashboar Route
Route::get('/dashboard', 'HomeController@index');

// Transaction Route
Route::get('/transaction', 'TransactionController@index');

// Ordering Route
Route::get('/view-order', 'OrderController@index');
Route::get('/buat-order', 'OrderController@create');
Route::post('/store-order', 'OrderController@store');

// Inventory Route
Route::get('/local-inventory', 'InventoryController@index');

// Inventory Route
Route::get('/ruang-produksi', 'ProduksiController@index');

// Products Route
Route::get('/products', 'ProductController@index');
Route::get('/create-products', 'ProductController@create');
Route::post('/store-products', 'ProductController@store');

// Costumer Route
Route::get('/costumer', 'InstansiController@index');
Route::get('/create-costumer', 'InstansiController@create');
Route::post('/store-costumer', 'InstansiController@store');

// Merek Route
Route::get('/merek', 'MerekController@index');
Route::post('/store-merek', 'MerekController@store');

// Formula
Route::get('/formula', 'FormulaController@index');

// Archive
Route::get('/archive', 'ArchiveController@index');

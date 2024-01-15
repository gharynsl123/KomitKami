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
Route::get('/user-configuration', 'UserController@index');
Route::get('/profile-user', 'UserController@profile');

// Dashboar Route
Route::get('/dashboard', 'HomeController@index');

// Transaction Route
Route::get('/transaction', 'TransactionController@index');

// Ordering Route
Route::get('/view-order', 'OrderController@index');

// Inventory Route
Route::get('/local-inventory', 'InventoryController@index');

// Products Route
Route::get('/products', 'ProductController@index');

// Costumer Route
Route::get('/costumer', 'InstansiController@index');

// Merek Route
Route::get('/merek', 'MerekController@index');

// Formula
Route::get('/formula', 'FormulaController@index');

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Category
Route::get('category', 'CategoryController@index')->name('category.index');
Route::post('category', 'CategoryController@store')->name('category.store');


// Articale
Route::get('articale', 'ArticaleController@index')->name('articale.index');
Route::post('articale', 'ArticaleController@store')->name('articale.store');

Route::get('articale_test','ArticaleController@test');
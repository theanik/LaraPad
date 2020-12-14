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
// socalite
Route::namespace('Auth')->group(function () {
    Route::get('auth/facebook/redirect','SocialiteController@redirectToFacebook')->name('login.facebook');
    Route::get('auth/facebook/callback','SocialiteController@handleFacebookCallback');

    Route::get('auth/github/redirect','SocialiteController@redirectToGithub')->name('login.github');
    Route::get('auth/github/callback','SocialiteController@handleGithubCallback');
    
});

Route::get('/home', 'HomeController@index')->name('home');

//Start Category
Route::get('category', 'CategoryController@index')->name('category.index');
Route::post('category', 'CategoryController@store')->name('category.store');

// End Category

//Start Articale
Route::middleware('auth')->group(function(){
	Route::get('articale', 'ArticaleController@index')->name('articale.index');
	Route::post('articale', 'ArticaleController@store')->name('articale.store');
});


// Eloquent
Route::get('articale_test','ArticaleController@test');

// Collection
Route::get('articale_collection','ArticaleController@articaleCollection');
// ^ service
Route::get('articale_filter','ArticaleController@articaleFilter');

// End Article
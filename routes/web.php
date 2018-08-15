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

// Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/api/v1/products/{type}', 'ProductController@getProducts');
Route::get('/api/v1/product/{product_id}', 'ProductController@getProduct');
Route::get('/api/v1/houses', 'ProductController@getAllHouse');
Route::get('/api/v1/house/{house_id}', 'ProductController@getHouse');

Route::get('/api/v1/image/home', 'ImageController@getImageHome');
Route::get('/api/v1/image/type', 'ImageController@getType');

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/home', 'Admin\HomeController@index')->name('admin.home');
Route::get('/artist/home', 'Artist\HomeController@index')->name('artist.home');
Route::get('/customer/home', 'Customer\HomeController@index')->name('customer.home');

Route::resource('/artist/products', 'Artist\ProductController');
Route::resource('/artist/categories', 'Artist\CategoryController');
Route::resource('/artist/tags', 'Artist\TagController');

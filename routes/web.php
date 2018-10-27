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
Route::get('/artist/categories/viewProducts/{category_id}', 'Artist\CategoryController@viewProducts')->name('categories.viewProducts');

Route::resource('/artist/tags', 'Artist\TagController');
Route::get('/artist/tags/viewProducts/{tag_id}', 'Artist\TagController@viewProducts')->name('tags.viewProducts');

Route::get('/shop', 'Shop\HomeController@index')->name('shop.home');
Route::get('/shop/cart', 'Shop\ShoppingCartController@index')->name('cart.home');

Route::get('/addToCart', 'Shop\ShoppingCartController@addToCart')->name('cart.add');

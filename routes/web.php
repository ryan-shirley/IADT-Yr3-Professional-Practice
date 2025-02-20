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

Route::get('/', 'HomeController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');

Route::get('/admin/home', 'Admin\HomeController@index')->name('admin.home');
Route::get('/artist', 'Artist\HomeController@index')->name('artist.home');
Route::get('/artist/home', 'Artist\HomeController@index')->name('artist.home');
Route::get('/customer', 'Customer\HomeController@index')->name('customer.home');
Route::get('/customer/home', 'Customer\HomeController@index')->name('customer.home');

// Artist Routes
Route::resource('/artist/products', 'Artist\ProductController');

Route::resource('/artist/categories', 'Artist\CategoryController');
Route::get('/artist/categories/viewProducts/{category_id}', 'Artist\CategoryController@viewProducts')->name('categories.viewProducts');

Route::resource('/artist/tags', 'Artist\TagController');
Route::get('/artist/tags/viewProducts/{tag_id}', 'Artist\TagController@viewProducts')->name('tags.viewProducts');

Route::resource('/artist/orders', 'Artist\OrderController');
Route::POST('/artist/shipments/create/', 'Artist\OrderController@saveShipment')->name('orders.create.shipment');

Route::get('/customer/orders', 'Customer\OrderController@index')->name('customer.orders.index');
Route::get('/customer/orders/{order_id}', 'Customer\OrderController@show')->name('customer.orders.show');

Route::resource('/customer/addresses', 'Customer\AddressController');

Route::get('/shop', 'Shop\HomeController@index')->name('shop.home');
Route::get('/shop/{product_id}', 'Shop\HomeController@show')->name('shop.product');
Route::get('/shop/category/{category_id}', 'Shop\CategoryController@index')->name('shop.category.all');

Route::get('/artist/settings', 'Artist\HomeController@settings')->name('artist.settings');
Route::get('/customer/settings', 'Customer\HomeController@settings')->name('customer.settings');

// Cart Routes
Route::get('/cart', 'CartController@view')->name('cart.view');
Route::post('/cart', 'CartController@add')->name('cart.add');
Route::get('/cart/edit', 'CartController@edit')->name('cart.edit');
Route::put('/cart', 'CartController@update')->name('cart.update');
Route::delete('cart/', 'CartController@remove')->name('cart.remove');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout');
Route::post('/cart/pay', 'CartController@pay')->name('cart.pay');
Route::get('/cart/checkout/confirmation/{order_id}', 'CartController@confirmation')->name('checkout.confirmation');

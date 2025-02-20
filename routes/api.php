<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('/checkout/shipping-address', 'Api\Customer\AddressController@createAddress');
Route::POST('/checkout/billing-address', 'Api\Customer\AddressController@createAddress');
Route::POST('/checkout/card', 'Api\Customer\CardController@createCard');
Route::GET('/artist/order/addresses/{id}', 'Api\Artist\AddressController@getAddresses');

Route::GET('/products', 'Api\Shop\ProductController@index');
Route::GET('/products/latest', 'Api\Shop\ProductController@latest');
Route::GET('/product/{id}', 'Api\Shop\ProductController@find');

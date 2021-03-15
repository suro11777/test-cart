<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', 'Api\AuthController@login')->name('login');
Route::post('register', 'Api\AuthController@register')->name('register');
Route::get('categories-all', 'Api\CategoryController@getAll')->name('categories.all');
Route::get('products', 'Api\ProductController@products')->name('products');
Route::get('product/{slug}', 'Api\ProductController@productBySlug')->name('product-by-slug');

Route::post('/cart/add/{id}', 'Api\CartController@add')->where('id', '[0-9]+')->name('cart.add');
Route::post('/cart/plus/{id}', 'Api\CartController@plus')->where('id', '[0-9]+')->name('cart.plus');
Route::post('/cart/minus/{id}', 'Api\CartController@minus')->where('id', '[0-9]+')->name('cart.minus');

Route::delete('/cart/remove/{id}', 'Api\CartController@remove')->where('id', '[0-9]+')->name('cart.remove');
Route::post('/cart/save-order', 'Api\CartController@saveOrder')->name('cart.save-order');

Route::resource('characteristics', 'Api\CharacteristicController');
Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::get('/orders', 'Api\OrderController@getAllOrders')->name('get.all');
    Route::get('logout', 'Api\AuthController@logout')->name('logout');
});


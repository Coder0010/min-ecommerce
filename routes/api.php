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

Route::resource('products', 'ProductController')->except('show', 'create', 'store', 'edit');
Route::post('merchants/{merchant}/products', 'ProductController@store')->name('products.store');
Route::get('products/merchant', 'ProductController@getMerchantProducts');
Route::get('auth/merchant', 'ProfileController@getMerchantProducts');

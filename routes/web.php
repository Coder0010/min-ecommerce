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

Auth::routes([
    'reset'    => false,
    'confirm'  => false,
    'verify'   => false,
]);

Route::get('/',function(){
    return view('index');
})->name('index');

Route::group(['namespace' => 'Auth'], function () {
    Route::get('profile', 'ProfileController@profile')->name('profile');
    Route::get('profile-edit', 'ProfileController@edit')->name('profile.edit');
    Route::patch('users-update', 'ProfileController@updateUserProfile')->name('users.update');
    Route::patch('user-update-password', 'ProfileController@updateupdatePassword')->name('users.update.password');
    Route::patch('merchants-update', 'ProfileController@updateMerchantProfile')->name('merchants.update');
});

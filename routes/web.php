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

Route::post('login', 'Api\LoginController@login')->name('login');
Route::post('login\otp', 'Api\LoginController@otp')->name('login-otp');
Route::post('product\upload', 'Api\UploadProductController')->name('upload-product');

//Route::get('/', function () {
//    return view('welcome');
//});

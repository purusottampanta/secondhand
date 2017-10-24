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
Route::get('auth/confirm/{confirmation_code}', 'Auth\RegisterController@getConfirm')->name('auth.confirm');
Route::get('auth/resend', 'Auth\LoginController@getResend');

Route::group(['namespace' => 'General'], function(){
	Route::get('/', [
		'as' => 'welcome',
		'uses' => 'WelcomeController@index',
	]);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

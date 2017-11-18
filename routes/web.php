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

Route::get('/redirect/{provider}', 'Auth\Social\SocialAuthController@redirect');
Route::get('/callback/{provider}', 'Auth\Social\SocialAuthController@callback');

Route::group(['namespace' => 'General'], function(){
	Route::get('/', [
		'as' => 'welcome',
		'uses' => 'WelcomeController@index',
	]);

	Route::get('/category/{category}', [
		'as' => 'general.category',
		'uses' => 'WelcomeController@productByCategory',
	]);

	Route::get('/ad/{category}/{slug}', [
		'as' => 'general.products.show',
		'uses' => 'WelcomeController@showProduct',
	]);

	Route::get('/featured', [
		'as' => 'featured',
		'uses' => 'WelcomeController@featuredOrRecentOnly',
	]);

	Route::get('/recent', [
		'as' => 'recent',
		'uses' => 'WelcomeController@featuredOrRecentOnly',
	]);

	Route::get('/general/{product}/add-to-cart', [
		'as' => 'general.products.addToCart',
		'uses' => 'ShoppingController@addToCart',
	]);
});


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

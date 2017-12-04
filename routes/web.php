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

	Route::post('/general/{product}/buy-now/{user?}/{incomplete?}', [
		'as' => 'general.products.buyNow',
		'uses' => 'ShoppingController@buyNow',
	]);

	Route::get('/general/continue-as-guest', [
		'as' => 'general.products.continueAsGuest',
		'uses' => 'ShoppingController@continueAsGuest',
	]);
});


Auth::routes();

Route::resource('/{product}/comments', 'General\CommentController', ['only' => [ 'store',
    'update', 'destroy'
	]]);


// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Users', 'middleware' => 'auth', 'prefix' => 'users'], function(){
	Route::get('/dashboard', [
	'as' => 'users.dashboard',
	'uses' => 'DashboardController@index',
	]);
	Route::get('/logout', [
		'as' => 'users.logout',
		'uses' => 'DashboardController@logout',
	]);

	Route::resource('products', 'ProductController', ['as' => 'users']);

	Route::get('profile/{user}/edit', [
		'as' => 'users.profile.edit',
		'uses' => 'UserController@edit',
	]);

	Route::patch('profile/{user}', [
		'as' => 'users.profile.update',
		'uses' => 'UserController@update',
	]);

	// Route:: get('/sellRequest', [
	// 	'as' => 'users.users.sellRequest',
	// 	'uses' => 'UserController@getSellRequest',
	// ]);
});

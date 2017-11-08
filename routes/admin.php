<?php

Route::get('/dashboard', [
	'as' => 'admin.dashboard',
	'uses' => 'DashboardController@index',
]);
Route::get('/logout', [
	'as' => 'admin.logout',
	'uses' => 'AdminAuthController@logout',
]);
Route::resource('users', 'UserController', ['as' => 'admin']);
Route::post('/products/statusUpdate/{product}', [
	'as' => 'admin.products.updateStatus',
	'uses' => 'ProductController@updateStatus',
]);
Route::resource('products', 'ProductController', ['as' => 'admin']);
Route::resource('sliders', 'SliderController', ['as' => 'admin']);
Route:: get('/sellRequest', [
	'as' => 'admin.users.sellRequest',
	'uses' => 'UserController@getSellRequest',
]);
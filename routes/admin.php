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
Route::resource('products', 'ProductController', ['as' => 'admin']);
Route:: get('/sellRequest', [
	'as' => 'admin.users.sellRequest',
	'uses' => 'UserController@getSellRequest',
]);
<?php

Route::get('/dashboard', [
	'as' => 'admin.dashboard',
	'uses' => 'DashboardController@index',
]);

Route::resource('users', 'UserController', ['as' => 'admin']);
Route::resource('sell', 'SellController', ['as' => 'admin']);
Route:: get('/sellRequest', [
	'as' => 'admin.users.sellRequest',
	'uses' => 'UserController@getSellRequest',
]);
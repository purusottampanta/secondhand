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

Route::post('/products/update-image-only/{product}', [
	'as' => 'admin.products.updateImageOnly',
	'uses' => 'ProductController@updateImageOnly',
]);

Route::post('/products/update/{product}', [
	'as' => 'admin.products.updateAjax',
	'uses' => 'ProductController@update',
]);

Route::resource('products', 'ProductController', ['as' => 'admin']);
Route::resource('sliders', 'SliderController', ['as' => 'admin']);
Route:: get('/sellRequest', [
	'as' => 'admin.users.sellRequest',
	'uses' => 'UserController@getSellRequest',
]);

Route::get('categories/{category}/category-list', 'CategoriesController@getCategoryList');

Route::resource('categories', 'CategoriesController', [
        'except' => ['create', 'edit'],
        'as' => 'admin'
    ]);
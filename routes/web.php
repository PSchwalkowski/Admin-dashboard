<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/', function() {
	return view('auth.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/users', 'UserController@index')->name('users.index');
	Route::get('/roles', 'RoleController@index')->name('roles.index');
	Route::get('/media', 'MediaController@index')->name('media.index');
	Route::get('/settings', 'SettingsController@index')->name('settings.index');
});

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
	Route::get('/', 'HomeController@home')->name('home');
	Route::get('/users', 'HomeController@users')->name('users.index');
	Route::get('/roles', 'HomeController@roles')->name('roles.index');
	Route::get('/media', 'HomeController@media')->name('media.index');
	Route::get('/settings', 'HomeController@settings')->name('settings.index');
});

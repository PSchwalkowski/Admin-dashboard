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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::group(['prefix' => 'users'], function() {
  Route::get('/', 'UserController@index');
  Route::get('/create', 'UserController@getCreate');
  Route::post('/create', 'UserController@postCreate');
});

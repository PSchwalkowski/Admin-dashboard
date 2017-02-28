<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
  'middleware' => 'api',
  'namespace' => 'Api'
], function() {

  Route::group(['prefix' => 'users'], function() {
    Route::get('/', 'UserController@getAll');
    Route::post('/', 'UserController@create');
    Route::put('/', 'UserController@edit');
    Route::delete('/', 'UserController@delete');
  });

  Route::group(['prefix' => 'roles'], function() {
    Route::get('/', 'RoleController@getAll');
    Route::post('/', 'RoleController@create');
    // Route::put('/', 'UserController@edit');
    // Route::delete('/', 'UserController@delete');
  });
});

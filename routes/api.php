<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
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
    Route::put('/', 'RoleController@edit');
    Route::delete('/', 'RoleController@delete');
  });

  Route::group(['prefix' => 'media'], function() {
    Route::get('/', 'MediaController@getAll');
    Route::post('/', 'MediaController@create');
    Route::put('/', 'MediaController@edit');
    Route::delete('/', 'MediaController@delete');
  });
});

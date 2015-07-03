<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
   'as' => 'pages.index',
   'uses' => 'PagesController@index'
]);
Route::get('auth/login', [
    'as' => 'auth.login.show',
    'uses' => 'Auth\AuthController@getLogin'
]);
Route::post('auth/login', [
    'as' => 'auth.login',
    'uses' => 'Auth\AuthController@postLogin'
]);

Route::get('auth/logout', [
    'as' => 'auth.logout',
    'uses' => 'Auth\AuthController@getLogout'
]);

Route::get('auth/register', [
    'as' => 'auth.register.show',
    'uses' => 'Auth\AuthController@getRegister'
]);

Route::post('auth/register', [
    'as' => 'auth.register',
    'uses' => 'Auth\AuthController@postRegister'
]);

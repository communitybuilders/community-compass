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

// Static pages.
Route::get('/', [
   'as' => 'organisations.index',
   'uses' => 'OrganisationController@index'
]);

Route::get('/pages', [
    'as' => 'pages.index',
    'uses' => 'PagesController@index'
]);

Route::get('auth/register', [
    'as' => 'auth.register.show',
    'uses' => 'Auth\AuthController@getRegister'
]);

// Registration.
Route::post('auth/register', [
    'as' => 'auth.register',
    'uses' => 'Auth\AuthController@postRegister'
]);

// Login/logout.
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

//ajax calls
Route::post('organisations/ajaxloadorganisations', 'OrganisationController@ajaxloadorganisations');
Route::post('organisations/nearby', 'OrganisationController@nearby');

// CRUD organisations.
Route::resource('organisations', 'OrganisationController');

// Claim an organisation
Route::post('organisation/claim', 'OrganisationController@claim');

Route::bind('token', function($token_str) {
    return \App\Token::whereToken($token_str)->first();
});

Route::get('token/process/{token}', 'TokenController@process');

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
   'uses' => 'OrganisationsController@index'
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
Route::post('organisations/ajaxloadorganisations', 'OrganisationsController@ajaxloadorganisations');
Route::post('organisations/closest', 'OrganisationsController@closest');

// CRUD organisations.
Route::resource('organisations', 'OrganisationsController');

// Claim an organisation
Route::post('organisation/claim', 'OrganisationsController@claim');

Route::bind('token', function($token_str) {
    return \App\Token::whereToken($token_str)->first();
});

Route::get('token/process/{token}', 'TokenController@process');

Route::get('test', function() {
    // 96 phillip st parramatta
    $lat = -33.8132992;
    $lng = 151.0094947;

    $orgs = App\Organisation::
        withImage()
        ->withWebsite()
        ->closest($lat, $lng)
        ->get()->toArray();

    dd($orgs);
});

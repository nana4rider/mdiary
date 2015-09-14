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

/*
 * ユーザ認証
 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

/*
 * ユーザ登録
 */
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/**
 * ログイン中
 */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return Redirect::to('/home');
    });

    Route::get('/home', 'HomeController@showHome');
});

// TODO: sample
Route::get('/sample', function () {
    return view('sample');
});

<?php

/*
|--------------------------------------------------------------------------
| アプリケーションのルート
|--------------------------------------------------------------------------
|
| ここでアプリケーションのルートを全て登録することが可能です。
| 簡単です。ただ、Laravelへ対応するURIと、そのURIがリクエスト
| されたときに呼び出されるコントローラーを指定してください。
|
*/

use Illuminate\Support\Facades\Auth;

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
    view()->composer('*', function ($view) {
        $view->with('currentUser', Auth::user());
    });

    Route::get('/', function () {
        return Redirect::to('/home');
    });

    Route::get('/home', 'HomeController@index');
});

// TODO: sample
Route::get('/sample', function () {
    return view('sample');
});

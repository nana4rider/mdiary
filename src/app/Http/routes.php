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
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/{provider}', 'Auth\OAuthController@getAuthorize');
Route::get('auth/{provider}/login', 'Auth\OAuthController@getLogin');

/**
 * ログイン中
 */
Route::group(['middleware' => 'auth', 'before' => 'csrf'], function () {
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

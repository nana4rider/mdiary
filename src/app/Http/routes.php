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

/**
 * ユーザ認証
 */
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/{provider}', 'Auth\SocialAuthController@getAuthorize');
Route::get('auth/{provider}/login', 'Auth\SocialAuthController@getLogin');

/**
 * ログイン中
 */
Route::group(['middleware' => 'auth', 'before' => 'csrf'], function () {
    view()->composer('*', function ($view) {
        $view->with('currentUser', Auth::user());
    });

    Route::get('/', function () {
        return Redirect::to('home');
    });

    /**
     * ホーム画面
     */
    Route::get('home', 'HomeController@index');

    /**
     * 日記
     */
    Route::resource('textDiary', 'TextDiaryController');

    /**
     * 作業日誌
     */
    Route::resource('workDiary', 'WorkDiaryController');

    /**
     * 作業記録
     */
    Route::resource('workRecord', 'WorkRecordController');

    /**
     * 集計
     */
    Route::get('aggregate/field', 'AggregateController@field');
    Route::get('aggregate/workDiary', 'AggregateController@workDiary');
});

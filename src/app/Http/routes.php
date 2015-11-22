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
Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
Route::controller('auth/{provider}', 'Auth\SocialAuthController', ['getAuthorize' => 'social.authorize']);

/**
 * ログイン中
 */
Route::group(['middleware' => 'auth', 'before' => 'csrf'], function () {
    view()->composer('*', function ($view) {
        $view->with('currentUser', Auth::user());
    });

    Route::get('/', function () {
        return Redirect::route('home');
    });

    /**
     * ホーム画面
     */
    Route::get('home', ['as' => 'home', 'uses' => 'HomeController@getIndex']);

    /**
     * 日記
     */
    Route::resource('textDiary', 'TextDiaryController', ['except' => 'show']);

    /**
     * 作業日誌
     */
    Route::resource('workDiary', 'WorkDiaryController');

    /**
     * 作業記録
     */
    Route::resource('workRecord', 'WorkRecordController');
    Route::post('workRecord/create/addPesticide',
        ['as' => 'workRecord.create.addPesticide', 'uses' => 'WorkRecordController@addPesticide']);
    Route::post('workRecord/create/deletePesticide/{id}',
        ['as' => 'workRecord.create.deletePesticide', 'uses' => 'WorkRecordController@deletePesticide']);

    /**
     * 集計
     */
    Route::get('aggregate/workField',
        ['as' => 'aggregate.workField', 'uses' => 'AggregateController@getWorkField']);
    Route::get('aggregate/workDiary',
        ['as' => 'aggregate.workDiary', 'uses' => 'AggregateController@getWorkDiary']);
});

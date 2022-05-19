<?php

namespace App\Providers;

use DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションサービスの初期化処理
     *
     * @return void
     */
    public function boot()
    {
        // SQLiteの外部キーを有効化
        if (DB::connection() instanceof \Illuminate\Database\SQLiteConnection) {
            DB::statement(DB::raw('PRAGMA foreign_keys=1'));
        }
    }

    /**
     * アプリケーションサービスの登録
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/13
 * Time: 20:36
 */

namespace App;

use Illuminate\Support\Facades\Auth;

/**
 * 登録、更新、削除時に認証ユーザIDを追加します
 * Class UserTrace
 * @package App
 */
trait UserTrace
{
    private static function setUserId($model, $key)
    {
        $model->$key = Auth::check() ? Auth::User()->id : null;
    }

    public static function bootUserTrace()
    {
        static::creating(function ($model) {
            static::setUserId($model, 'created_user_id');
            static::setUserId($model, 'updated_user_id');
        });

        static::updating(function ($model) {
            static::setUserId($model, 'updated_user_id');
        });

        static::deleting(function ($model) {
            static::setUserId($model, 'deleted_user_id');
        });
    }
}
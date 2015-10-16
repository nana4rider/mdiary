<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/13
 * Time: 20:36
 */

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * 登録、更新、削除時に認証ユーザIDを追加します
 * Class UserInfo
 * @package App
 */
trait UserInfo
{
    protected static function setUserId(Model $model, $key)
    {
        $model->setAttribute($key, Auth::check() ? Auth::User()->id : null);
    }

    public static function bootUserInfo()
    {
        static::creating(function (Model $model) {
            static::setUserId($model, 'created_user_id');
            static::setUserId($model, 'updated_user_id');
        });

        static::updating(function (Model $model) {
            static::setUserId($model, 'updated_user_id');
        });

        static::deleting(function (Model $model) {
            static::setUserId($model, 'deleted_user_id');
        });
    }
}

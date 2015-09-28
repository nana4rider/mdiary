<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use McCool\LaravelAutoPresenter\HasPresenter;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract, HasPresenter
{
    use Authenticatable, Authorizable, CanResetPassword;
    use SoftDeletes;
    use UserInfo;

    /**
     * モデルで使用するデータベーステーブル
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * モデルのJSON形式に含めない属性
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    public function getPresenterClass()
    {
        return UserPresenter::class;
    }
}

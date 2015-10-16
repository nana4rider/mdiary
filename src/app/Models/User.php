<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use SoftDeletes;
    use UserInfo;

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

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}

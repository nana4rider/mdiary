<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    // 予約グループ[1-10]
    const SYSTEM = 1;
    const ADMIN = 2;
    const DEVELOP = 3;
    const GUEST = 4;

    use SoftDeletes;
    use UserInfo;
}

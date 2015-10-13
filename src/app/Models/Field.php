<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Field extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'fields';

}

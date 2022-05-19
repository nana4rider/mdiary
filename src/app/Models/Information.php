<?php

namespace App\Models;

use App\Models\Traits\Grouping;
use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use SoftDeletes;
    use UserInfo;
    use Grouping;

    protected $dates = ['datetime'];
}

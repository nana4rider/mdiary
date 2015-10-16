<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $dates = ['time'];

    public function getFormatTimeAttribute()
    {
        return $this->time->format(config('format.date'));
    }
}

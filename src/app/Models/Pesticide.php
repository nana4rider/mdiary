<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesticide extends Model
{
    use SoftDeletes;
    use UserInfo;

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function crops()
    {
        return $this->belongsToMany(Crop::class);
    }
}

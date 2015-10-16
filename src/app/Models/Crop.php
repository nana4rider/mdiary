<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crop extends Model
{
    use SoftDeletes;
    use UserInfo;

    public function cultivars()
    {
        return $this->hasMany(Cultivar::class);
    }
}

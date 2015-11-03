<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;
    use UserInfo;

    const PEST_CONTROL = 8;

    public function crops()
    {
        return $this->belongsToMany(Crop::class);
    }
}

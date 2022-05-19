<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cultivar extends Model
{
    use SoftDeletes;
    use UserInfo;

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}

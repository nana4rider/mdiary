<?php

namespace App\Models;

use App\Models\Traits\Grouping;
use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkPestControl extends Model
{
    use SoftDeletes;
    use UserInfo;
    use Grouping;

    public function pesticide()
    {
        return $this->belongsTo(Pesticide::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkPestControl extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'work_pest_controls';

    public function pesticide()
    {
        return $this->belongsTo(Pesticide::class);
    }
}

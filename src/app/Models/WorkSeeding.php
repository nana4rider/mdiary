<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkSeeding extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'work_seedings';

    public function cultivar()
    {
        return $this->belongsTo(Cultivar::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pesticide extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'pesticides';

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

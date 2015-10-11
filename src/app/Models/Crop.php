<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crop extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'crops';

    public function cultivars()
    {
        return $this->hasMany(Cultivar::class);
    }
}

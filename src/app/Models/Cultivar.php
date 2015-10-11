<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cultivar extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'cultivars';

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}

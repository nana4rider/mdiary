<?php

namespace App\Models;

use App\Models\Traits\Grouping;
use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkSeeding extends Model
{
    use SoftDeletes;
    use UserInfo;
    use Grouping;

    protected $fillable = ['intrarow_spacing'];

    public function cultivar()
    {
        return $this->belongsTo(Cultivar::class);
    }
}

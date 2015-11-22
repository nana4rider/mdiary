<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $casts = [
        'use_complete' => 'boolean',
        'use_seeding' => 'boolean',
        'use_pest_control' => 'boolean'
    ];

    public function crops()
    {
        return $this->belongsToMany(Crop::class);
    }
}

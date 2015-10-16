<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkDiary extends Model
{
    use SoftDeletes;
    use UserInfo;

    public function workRecords()
    {
        return $this->belongsToMany(WorkRecord::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}

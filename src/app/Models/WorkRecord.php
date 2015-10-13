<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkRecord extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'work_records';

    protected $dates = ['datetime'];

    public function workDiaries()
    {
        return $this->belongsToMany(WorkDiary::class);
    }

    public function workSeeding()
    {
        return $this->hasOne(WorkSeeding::class);
    }

    public function workPestControls()
    {
        return $this->hasMany(WorkPestControl::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}

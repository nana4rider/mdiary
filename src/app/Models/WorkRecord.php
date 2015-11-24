<?php

namespace App\Models;

use App\Models\Traits\Grouping;
use App\Models\Traits\UserInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkRecord extends Model
{
    use SoftDeletes;
    use UserInfo;
    use Grouping;

    protected $fillable = ['datetime_input'];

    protected $dates = ['datetime'];

    /**
     * 日付を整形して取得
     * @return string
     */
    public function getDatetimeInputAttribute()
    {
        return $this->datetime->format(config('format.input.datetime-local'));
    }

    /**
     * 日付をCarbonに変換して設定
     * @param $value
     */
    public function setDatetimeInputAttribute($value)
    {
        $this->datetime = Carbon::createFromFormat(config('format.input.datetime-local'), $value);
    }

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

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    /**
     * 作業日誌IDを取得
     * @return mixed
     */
    public function getWorkDiaryIdsAttribute()
    {
        return $this->workDiaries->lists('id')->all();
    }

    /**
     * 株間を取得
     * @return mixed
     */
    public function getIntrarowSpacingAttribute()
    {
        if (!$this->workSeeding) {
            return null;
        }

        return $this->workSeeding->intrarow_spacing;
    }

    public function getCultivarIdAttribute()
    {
        if (!$this->workSeeding) {
            return null;
        }

        return $this->workSeeding->cultivar_id;
    }
}

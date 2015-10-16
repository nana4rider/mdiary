<?php

namespace App\Models;

use App\Models\Traits\Grouping;
use App\Models\Traits\UserInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Information extends Model
{
    use SoftDeletes;
    use UserInfo;
    use Grouping;

    /**
     * 日付を整形して取得
     * @param $value
     * @return string
     */
    public function getDatetimeAttribute($value)
    {
        return Carbon::parse($value)->format(config('format.date'));
    }

    /**
     * 日付をCarbonに変換して設定
     * @param $value
     */
    public function setDatetimeAttribute($value)
    {
        $this->attributes['datetime'] =
            Carbon::createFromFormat(config('format.date'), $value)->toDateString();
    }

}

<?php

namespace App\Models;

use App\Models\Traits\Grouping;
use App\Models\Traits\UserInfo;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextDiary extends Model
{
    use SoftDeletes;
    use UserInfo;
    use Grouping;

    protected $fillable = ['title', 'body', 'datetime_input'];

    protected $dates = ['datetime'];

    /**
     * TextDiaryCategory
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function textDiaryCategories()
    {
        return $this->belongsToMany(TextDiaryCategory::class);
    }

    /**
     * Flickr
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function flickrs()
    {
        return $this->belongsToMany(Flickr::class);
    }

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

    /**
     * カテゴリIDを取得
     * @return mixed
     */
    public function getCategoryIdsAttribute()
    {
        return $this->textDiaryCategories->lists('id')->all();
    }
}

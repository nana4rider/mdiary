<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextDiary extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'text_diaries';

    protected $fillable = ['title', 'body', 'datetime'];

    /**
     * カテゴリIDのキャッシュ
     * @var
     */
    protected $categoryIds = null;

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
     * @param $value
     * @return string
     */
    public function getDatetimeAttribute($value)
    {
        return Carbon::parse($value)->format(config('format.datetime'));
    }

    /**
     * 日付をCarbonに変換して設定
     * @param $value
     */
    public function setDatetimeAttribute($value)
    {
        $this->attributes['datetime'] =
            Carbon::createFromFormat(config('format.datetime'), $value)->toDateTimeString();
    }

    /**
     * カテゴリIDを取得
     * @return mixed
     */
    public function getCategoryIdsAttribute()
    {
        if (is_null($this->categoryIds)) {
            $this->categoryIds = $this->textDiaryCategories()->lists('id')->all();
        }

        return $this->categoryIds;
    }
}

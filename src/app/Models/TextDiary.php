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

    protected $fillable = ['title', 'body', 'datetimeText'];

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
     * @return string
     */
    public function getDatetimeTextAttribute()
    {
        return Carbon::parse($this->datetime)->format(config('format.datetime'));
    }

    /**
     * 日付をCarbonに変換して設定
     * @param $value
     */
    public function setDatetimeTextAttribute($value)
    {
        $this->datetime = Carbon::createFromFormat(config('format.datetime'), $value);
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

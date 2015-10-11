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

    protected $dates = ['datetime'];

    public function textDiaryCategories()
    {
        return $this->belongsToMany(TextDiaryCategory::class);
    }

    public function flickrs()
    {
        return $this->belongsToMany(Flickr::class);
    }

    public function getFormatDatetimeAttribute()
    {
        return $this->datetime->format(config('format.datetime'));
    }

    public function setDatetimeAttribute($value)
    {
        if ($value instanceof Carbon) {
            $this->attributes['datetime'] = $value;
        } else {
            $this->attributes['datetime'] = Carbon::createFromFormat(config('format.datetime'), $value);
        }
    }

    public function getCategoryIdsAttribute()
    {
        return $this->textDiaryCategories()->lists('id')->all();
    }
}

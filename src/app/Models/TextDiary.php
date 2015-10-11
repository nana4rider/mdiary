<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextDiary extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'text_diaries';

    protected $fillable = ['title', 'body'];

    protected $dates = ['datetime'];

    public function textDiaryCategories()
    {
        return $this->belongsToMany(TextDiaryCategory::class);
    }

    public function flickrs()
    {
        return $this->belongsToMany(Flickr::class);
    }
}

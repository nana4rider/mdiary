<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextDiaryCategory extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'text_diary_categories';

    public function textDiaries()
    {
        return $this->belongsToMany(TextDiary::class);
    }
}

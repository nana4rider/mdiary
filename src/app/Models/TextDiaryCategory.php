<?php

namespace App\Models;

use App\Models\Traits\UserInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextDiaryCategory extends Model
{
    use SoftDeletes;
    use UserInfo;

    public function textDiaries()
    {
        return $this->belongsToMany(TextDiary::class);
    }
}

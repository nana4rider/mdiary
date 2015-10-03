<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TextDiary extends Model
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'text_diarys';

    //
}

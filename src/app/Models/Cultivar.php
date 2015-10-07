<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cultivar extends Model
{
    use SoftDeletes;
    use UserInfo;

    /**
     * モデルで使用するデータベーステーブル
     *
     * @var string
     */
    protected $table = 'cultivars';

}

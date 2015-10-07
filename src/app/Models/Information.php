<?php

namespace App\Models;

use App\Presenters\InformationPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Information extends Model implements HasPresenter
{
    use SoftDeletes;
    use UserInfo;

    /**
     * モデルで使用するデータベーステーブル
     *
     * @var string
     */
    protected $table = 'informations';

    protected $dates = ['time'];

    public function getPresenterClass()
    {
        return InformationPresenter::class;
    }
}

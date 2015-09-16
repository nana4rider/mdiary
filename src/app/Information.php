<?php

namespace App;

use App\Presenters\InformationPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Information extends Model implements HasPresenter
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'informations';

    protected $dates = ['time'];

    public function getPresenterClass()
    {
        return InformationPresenter::class;
    }
}

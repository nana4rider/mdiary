<?php

namespace App\Models;

use App\Presenters\FlickrPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;

class Flickr extends Model implements HasPresenter
{
    use SoftDeletes;
    use UserInfo;

    protected $table = 'flickrs';

    public function getPresenterClass()
    {
        return FlickrPresenter::class;
    }
}

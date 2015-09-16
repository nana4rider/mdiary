<?php

namespace App\Presenters;

use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/16
 * Time: 21:42
 */
class InformationPresenter extends BasePresenter
{
    public function formatTime()
    {
        return $this->time->format(config('format.date'));
    }
}
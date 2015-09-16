<?php

namespace App\Presenters;
use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/16
 * Time: 21:42
 */
class UserPresenter extends BasePresenter
{
    /**
     * フルネームを取得
     *
     * @return string
     */
    public function name()
    {
        return $this->last_name . " " . $this->first_name;
    }
}
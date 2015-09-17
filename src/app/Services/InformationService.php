<?php

namespace App\Services;

use App\Models\Information;

/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/17
 * Time: 21:40
 */
class InformationService
{
    public function findNewer($max)
    {
        return Information::orderBy('time', 'desc')->limit($max)->get();
    }
}
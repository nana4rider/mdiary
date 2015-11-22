<?php

/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/18
 * Time: 23:19
 */

function message($id, $transParameters = [], $rawParameters = [])
{
    $mergeParameters = [];
    foreach ($transParameters as $key => $value) {
        $mergeParameters[$key] = label($value);
    }
    $mergeParameters += $rawParameters;

    return trans('messages.' . $id, $mergeParameters);
}

function label($id)
{
    return trans('labels.' . $id);
}

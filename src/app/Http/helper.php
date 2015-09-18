<?php

/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/18
 * Time: 23:19
 */

function message($id, $parameters = [])
{
    $transParameters = [];
    foreach ($parameters as $key => $value) {
        $transParameters[$key] = label($value);
    }

    return trans('messages.' . $id, $transParameters);
}

function label($id)
{
    return trans('labels.' . $id);
}

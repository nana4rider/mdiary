<?php
use Illuminate\Database\Eloquent\Collection;

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

function options(Collection $collection, $key = 'id', $value = 'name')
{
    $options = [];

    if (is_null($key)) {
        foreach ($collection as $model) {
            $options[] = $model->$value;
        }
    } else {
        foreach ($collection as $model) {
            $options[$model->$key] = $model->$value;
        }
    }

    return $options;
}

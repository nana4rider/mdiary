<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/10/05
 * Time: 22:23
 */

namespace App\Http\Controllers;


class AggregateController extends Controller
{
    public function getField()
    {
        return view('aggregate.field');
    }

    public function getWorkDiary()
    {
        return view('aggregate.workDiary');
    }
}
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
    public function getWorkField()
    {
        return view('aggregate.workField');
    }

    public function getWorkDiary()
    {
        return view('aggregate.workDiary');
    }
}
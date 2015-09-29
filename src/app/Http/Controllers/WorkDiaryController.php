<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;


class WorkDiaryController extends Controller
{
    public function create()
    {
        return view('workDiary.create');
    }
}
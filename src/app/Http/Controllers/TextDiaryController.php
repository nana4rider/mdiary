<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;


class TextDiaryController extends Controller
{
    public function index()
    {
        return view('textDiary.index');
    }

    public function create()
    {
        return view('textDiary.create');
    }
}
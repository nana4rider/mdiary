<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/28
 * Time: 22:49
 */

namespace App\Http\Controllers;


class WorkRecordController extends Controller
{
    public function index()
    {
        return view('workRecord.index');
    }

    public function create()
    {
        return view('workRecord.create');
    }
}
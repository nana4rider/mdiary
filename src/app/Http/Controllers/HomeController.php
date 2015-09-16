<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/14
 * Time: 22:31
 */

namespace App\Http\Controllers;

use App\Information;

class HomeController extends Controller
{
    public function index()
    {
        $maxInformation = config('const.max_home_information');
        $informations = Information::orderBy('time', 'desc')->limit($maxInformation)->get();

        return view('home', compact('informations'));
    }
}

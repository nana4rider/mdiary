<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/14
 * Time: 22:31
 */

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Information;

class HomeController extends Controller
{
    public function getIndex()
    {
        $maxInformation = config('const.max_home_information');
        $informations = Information::orGroup(Group::SYSTEM)->orderBy('datetime', 'desc')->limit($maxInformation)->get();

        return view('home.index', compact('informations'));
    }
}

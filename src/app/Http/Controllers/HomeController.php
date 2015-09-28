<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/14
 * Time: 22:31
 */

namespace App\Http\Controllers;

use App\Services\Models\InformationService;

class HomeController extends Controller
{
    public function index(InformationService $service)
    {
        $maxInformation = config('const.max_home_information');
        $informations = $service->findNewer($maxInformation);

        return view('home.index', compact('informations'));
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Shunichiro AKI
 * Date: 2015/09/14
 * Time: 22:31
 */

namespace App\Http\Controllers;

use App\Services\InformationService;

class HomeController extends Controller
{
    private $service;

    function __construct(InformationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $maxInformation = config('const.max_home_information');
        $informations = $this->service->findNewer($maxInformation);

        return view('home.index', compact('informations'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // /**
    //  * __construct
    //  *
    //  * @param \Illuminate\Routing\Route $route Route
    //  * @param \Illuminate\Http\Request  $request Request
    //  *
    //  * @return void
    //  */
    // public function __construct(Route $route, Request $request)
    // {
    //     $logMessage = [
    //         'request' => env('REQUEST_METHOD'),
    //         'action' => $route->getActionName(),
    //         'param' => $request->all()
    //     ];

    //     Log::debug(json_encode($logMessage));
    // }
}

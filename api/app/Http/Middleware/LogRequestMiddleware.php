<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Torann\GeoIP\Facades\GeoIP;
use Illuminate\Support\Facades\Auth;
use App\Models\Log as logModel;

class LogRequestMiddleware
{

    public function handle($request, Closure $next)
    {

 

        return $next($request);
    }

    // Function to get country from IP address
    private function getCountryFromIp($ip)
    {
        
    }
}

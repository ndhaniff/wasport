<?php

/**
 * This is middleware to check yippi code on every link
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use App\Http\Controllers\API\YippiController;
use App\User;
use Illuminate\Support\Facades\Auth; 
use Ixudra\Curl\Facades\Curl;

class StravaConnect
{
    /**
     * After middleware
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        $response = $next($request);

        if($request->query("code")) {
            $code = $request->query("code");
            //redirect to user
            return redirect()->route("user.dashboard")->with(array('code' => $code));
            
        }

        return $response;   
    }
}

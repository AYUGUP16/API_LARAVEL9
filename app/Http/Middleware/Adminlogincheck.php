<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Adminlogincheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //dd('testet');

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class Vender
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard='vender')
    {
        if(!\Auth::guard($guard)->check()){
            //return response('Not Allow Access',403);
            return redirect('vender/login');
        }
        return $next($request);
    }
}

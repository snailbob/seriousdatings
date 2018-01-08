<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if(Auth::user()->verified == 1){
                // return redirect('/verifyPlease');
                // return \Redirect::to('/verifyPlease');
            }
        }
        return $next($request);
    }

}
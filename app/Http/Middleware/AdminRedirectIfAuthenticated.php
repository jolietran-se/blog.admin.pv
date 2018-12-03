<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminRedirectIfAuthenticated
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

        // dd(Auth::guard('admin')->check());
        if (Auth::guard('admin')->check()) {

            return redirect('/home');
        }
        return $next($request);
    }
}

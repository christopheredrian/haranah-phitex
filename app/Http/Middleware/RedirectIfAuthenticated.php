<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->hasRole("admin") or Auth::user()->hasRole("superadmin")){
                return redirect('/admin/home');
            } else if(Auth::user()->hasRole("buyer")){
                return redirect('/buyer/home');
            } else {
                return redirect('/seller/home');
            }
        }

        return $next($request);
    }
}

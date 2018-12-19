<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(session()->has('locale')) app()->setLocale(session('locale'));
        if(!Auth::guard($guard)->check())
        {

            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}

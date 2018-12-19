<?php

namespace App\Http\Middleware;

use Closure;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param null $status
     * @return mixed
     */
    public function handle($request, Closure $next, $status = null)
    {

        if(!$status)
        {
            if(settings()->status == 'close')
                return redirect()->route('maintenance');
        } else
        {
            if(settings()->status == 'open')
                return redirect('/');
        }

        return $next($request);
    }
}

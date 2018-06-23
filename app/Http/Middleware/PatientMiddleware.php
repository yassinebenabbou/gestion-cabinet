<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Role;

class PatientMiddleware
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
        if(!(Auth::check())) {
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}

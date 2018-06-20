<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Role;

class ReceptionistMiddleware
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
        if(!(Auth::user()->hasRoleReceptionist() || Auth::user()->hasRoleDoctor())) {
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}

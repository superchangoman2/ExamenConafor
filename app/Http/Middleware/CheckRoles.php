<?php

namespace App\Http\Middleware;
use App\User;

use Closure;

class CheckRoles
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
        //dd(Auth::guard($role));
        if(auth()->user()->role === 'ADMINISTRADOR')
        {    
            return $next($request);
        }

        return redirect('/');
    }
}

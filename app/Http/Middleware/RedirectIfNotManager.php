<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfNotManager
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
        if (Auth::user()->isSuperAdmin() || Auth::user()->isMD() || Auth::user()->isManager()) {
        
        }else{
            return redirect()->back()->with('warning','You do not have authorization!');
        }

        return $next($request);
    }
}

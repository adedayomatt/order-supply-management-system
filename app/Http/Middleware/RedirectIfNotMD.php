<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfNotMD
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
        if (Auth::guard()->check() && !Auth::guard()->user()->isMD()) {
            return redirect()->back()->with('info','You do not have authorization!');
        }

        return $next($request);
    }
}

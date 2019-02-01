<?php

namespace App\Http\Middleware;

use Closure;

class RedirectReg
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
        return redirect()->back()->with('info','Not allowed!');

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsOpd
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->isOpd()) {
            return $next($request);
        }

        return to_route('dashboard');
    }
}

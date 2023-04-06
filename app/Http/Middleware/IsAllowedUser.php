<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAllowedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (in_array('admin', $roles) || in_array('opd', $roles)) {
            return $next($request);
        }

        return to_route('dashboard');
    }
}

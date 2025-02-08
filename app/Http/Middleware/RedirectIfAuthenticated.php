<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        //can use the same middleware for other users too. define route in guards to make it dynamic.
        if (Auth::guard($guard)->check()) {
            $indexRoute = config("auth.guards.{$guard}.index_route");
            return redirect()->route($indexRoute);
        }
        return $next($request);
    }
}

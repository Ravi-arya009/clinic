<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        //can use the same middleware for other users too. define route in guards to make it dynamic.
        if (!Auth::guard($guard)->check()) {
            // can include clinic user check by adding a isclinic admin parameter is guard.
            $loginRoute = config("auth.guards.{$guard}.login_route");
            return redirect()->route($loginRoute);
        }
        view()->share([
            'loggedInUser' => auth()->guard($guard)->user(),
            'userRolePrefix' => config("auth.guards.{$guard}.prefix"),
            'userRole' => config("auth.guards.{$guard}.userRole"),
        ]);
        return $next($request);
    }
}

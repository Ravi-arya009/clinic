<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function authenticate($credentials, $guard)
    {
        if (Auth::guard($guard)->attempt($credentials)) {
            Request::session()->regenerate();
            $indexRoute = config("auth.guards.$guard.index_route");
            return [
                'status' => 1,
                'message' => 'Authentication successful',
                'redirect_route' => $indexRoute,
            ];
        } else {
            return [
                'status' => 0,
                'message' => 'Incorrect Phone or Password',
            ];
            // return back()->withErrors(['login' => 'Incorrect Phone or Password']);
        }
    }
}

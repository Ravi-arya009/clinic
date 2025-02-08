<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('super_admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|digits_between:10,13',
            'password' => 'required|min:4',
        ]);

        if (Auth::guard('super_admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $indexRoute = config('auth.guards.super_admin.index_route');
            return redirect()->route($indexRoute);
        } else {
            return back()->withErrors(['login' => 'Incorrect Phone or Password']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('super_admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $loginRoute = config('auth.guards.super_admin.login_route');
        return redirect()->route($loginRoute);
    }
}

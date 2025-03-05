<?php

namespace App\Http\Controllers\super_admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $Authservice;

    public function __construct(
        AuthService $Authservice
    ) {
        $this->Authservice = $Authservice;
    }

    public function login()
    {
        return view('super_admin.login');
    }

    public function authenticate(AuthenticateRequest $request)
    {
        $validatedData = $request->validated();
        $response = $this->Authservice->authenticate($validatedData, 'super_admin');

        if ($response['status'] == 1) {
            return redirect()->route($response['redirect_route']);
        } else {
            return back()->with(['error' => $response['message']]);
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

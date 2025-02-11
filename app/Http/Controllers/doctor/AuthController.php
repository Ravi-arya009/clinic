<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    protected $clinicId;

    public function __construct()
    {
        $this->clinicId = Session::get('current_clinic')['id'];
    }

    public function login()
    {
        return view('doctor.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits_between:10,13',
            'password' => 'required|min:4',
        ]);
        //checking if user role is doctor and belongs to clinic he's trying to log in into.
        $user = User::where('phone', $request->phone)->where('clinic_id', $this->clinicId)->where('role', config('role.doctor'))->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Incorrect Phone or Password']);
        }

        Auth::guard('doctor')->login($user);

        $request->session()->regenerate();
        $indexRoute = config('auth.guards.doctor.index_route');
        return redirect()->route($indexRoute);
    }

    public function logout(Request $request)
    {
        Auth::guard('doctor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $loginRoute = config('auth.guards.doctor.login_route');
        return redirect()->route($loginRoute);
    }
}

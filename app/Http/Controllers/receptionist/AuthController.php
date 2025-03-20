<?php

namespace App\Http\Controllers\receptionist;

use App\Http\Controllers\Controller;
use App\Models\ClinicUser;
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
        return view('receptionist.login');
    }

    public function authenticate(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|digits_between:10,13',
            'password' => 'required|min:4',
        ]);
        //checking if user role is receptionish and belongs to clinic he's trying to log in into.
        $user = User::where('phone', $validatedData['phone'])->select(['id', 'password'])->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Incorrect Phone or Password']);
        }

        $clinicUser = ClinicUser::where('user_id', $user->id)->where('clinic_id', $this->clinicId)->where('role_id', config('role.receptionist'))->firstOrFail();

        if (!$clinicUser) {
            return back()->withErrors(['error' => 'Unauthorized access']);
        }

        Auth::guard('receptionist')->login($user);

        $request->session()->regenerate();
        $indexRoute = config('auth.guards.receptionist.index_route');
        return redirect()->route($indexRoute);
    }

    public function logout(Request $request)
    {
        Auth::guard('receptionist')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $loginRoute = config('auth.guards.receptionist.login_route');
        return redirect()->route($loginRoute);
    }
}

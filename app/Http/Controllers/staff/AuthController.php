<?php

namespace App\Http\Controllers\staff;

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
        return view('staff.login');
    }

    public function authenticate(Request $request)
    {
        $validatedData = $request->validate([
            'phone' => 'required|digits_between:10,13',
            'password' => 'required|min:4',
        ]);

        $user = User::where('phone', $validatedData['phone'])->select(['id', 'password'])->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Incorrect Phone or Password']);
        }

        $clinicUser = ClinicUser::where('user_id', $user->id)->where('clinic_id', $this->clinicId)->where('role_id', config('role.staff'))->firstOrFail();

        if (!$clinicUser) {
            return back()->withErrors(['error' => 'Unauthorized access']);
        }

        Auth::guard('staff')->login($user);

        $request->session()->regenerate();
        $indexRoute = config('auth.guards.staff.index_route');
        return redirect()->route($indexRoute);
    }

    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $loginRoute = config('auth.guards.staff.login_route');
        return redirect()->route($loginRoute);
    }
}

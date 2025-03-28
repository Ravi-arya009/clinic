<?php

namespace App\Services;

use App\Models\ClinicUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class AuthService
{
    protected $clinicId;

    public function __construct() {}

    public function authenticate($credentials, $guard)
    {
        if (Auth::guard($guard)->attempt($credentials)) {
            $user = Auth::guard($guard)->user();
            if (config("auth.guards.{$guard}.isClinicUser")) {
                $clinicId = $this->clinicId = Session::get('current_clinic')['id'];
                $clinicUser = ClinicUser::where('user_id', $user->id)->where('clinic_id', $this->clinicId)->where('role_id', config('role.admin'))->firstOrFail();
                if (!$clinicUser) {
                    return [
                        'status' => 0,
                        'message' => 'Unauthorized access',
                    ];
                }
            }

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

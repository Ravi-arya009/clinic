<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function create()
    {
        return view('admin.create_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13|unique:users,phone',
            'password' => 'required|min:4|confirmed',
            'role' => 'required|in:1,2,3,4',
        ]);

        User::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'User registered successfully!');

        // show messages properly after frontend integration
        //return to edit profile after frontend integration
        //this function will be used when user registers himself.
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|digits_between:10,13',
            'password' => 'required|min:4',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            switch ($user->role) {
                case config('role.admin'):
                    return redirect()->route('admin.dashboard');
                    break;
                case config('role.doctor'):
                    return redirect()->route('doctor.dashboard');
                    break;
                case config('role.staff'):
                    return redirect()->route('staff.dashboard');
                    break;
                case config('role.patient'):
                    return redirect()->route('patient.dashboard');
                    break;

                default:
                    //return to error page.
                    break;
            }
        } else {
            echo "something went wrong";
        }

        // show messages properly adter frontend integration
        //return to respective dashboard after frontend integration
        //set role check during login
    }

    public function showPatientRegistrationForm()
    {
        return view('patient.register');
    }

    public function patientRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|digits_between:10,13|unique:patients,phone',
            'password' => 'required|min:4|confirmed',
        ]);

        Patient::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Registeration successfull!');
    }

    public function showPatientLoginForm()
    {
        return view('patient.login');
    }

    public function logout()
    {
        Auth::logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();
    }

}

<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\StorePatientRequest;
use App\Http\Requests\Patients\StorePatientRequest as PatientsStorePatientRequest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function register()
    {
        return view('patient.register');
    }

    public function store(PatientsStorePatientRequest $request)
    {
        $ValidatedData = $request->validated();

        Patient::create([
            'id' => Str::uuid(),
            'name' => $ValidatedData['name'],
            'phone' => $ValidatedData['phone'],
            'password' => Hash::make($ValidatedData['password']),
        ]);

        if (Auth::guard('patients')->attempt(['phone' => $ValidatedData['phone'], 'password' => $ValidatedData['password']])) {
            $request->session()->regenerate();
        }

        return redirect()->route('patient.login')->with('success', 'Registeration successfull, Login!');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'phone' => 'required|digits_between:10,13',
            'password' => 'required|min:4',
        ]);

        if (Auth::guard('patients')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('patient.dashboard');
        } else {
            return back()->withErrors(['login' => 'Incorrect Phone or Password']);
        }
    }

    public function login()
    {
        return view('patient.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('patients')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}

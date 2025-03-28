<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthenticateRequest;
use App\Models\Patient;
use App\Services\AuthService;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    private $otpService, $Authservice;
    public function __construct(OtpService $otpService, AuthService $Authservice)
    {
        $this->otpService = $otpService;
        $this->Authservice = $Authservice;
    }

    public function login(Request $request)
    {
        // find a better solution to send views dynamically
        $guard = $request->attributes->get('guard');
        $loginRoute = config("auth.guards.{$guard}.login_route");
        return view($guard . '.login');
    }

    public function authenticate(AuthenticateRequest $request)
    {
        $validatedData = $request->validated();
        $guard = $request->attributes->get('guard');
        $response = $this->Authservice->authenticate($validatedData, $guard);


        if ($response['status'] == 1) {
            return redirect()->route($response['redirect_route']);
        } else {
            return back()->with(['error' => $response['message']]);
        }
    }

    public function logout(Request $request)
    {
        $guard = $request->attributes->get('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $loginRoute = config("auth.guards.{$guard}.login_route");
        return redirect()->route($loginRoute);
    }



    ############################# OTP #############################
    public function patientPhoneNumberCheck(Request $request)
    {
        $phone = $request->phone;
        $patient = Patient::where('phone', $phone)->first();
        if ($patient == null) {
            return [
                'status' => 0,
                'message' => 'Mobile Number Not Registered'
            ];
        } else {
            $request->session()->put('otp_phone', $request->phone);
            $this->otpService->generate($patient->id);
            return [
                'status' => 1,
            ];
        }
    }

    public function otpVerify(Request $request)
    {
        try {
            $digits = $request->all();
            $otp = implode('', $digits);

            if (!session('otp_phone')) {
                return [
                    'status' => 0,
                    'message' => 'No OTP session found'
                ];
            }

            $user = Patient::where('phone', session('otp_phone'))->first();

            if (!$user) {
                return [
                    'status' => 0,
                    'message' => 'User not found'
                ];
            }

            // Add logging to understand what's happening
            Log::info('OTP Verification Attempt', [
                'phone' => session('otp_phone'),
                'otp' => $otp
            ]);

            if ($this->otpService->validate($user, $otp)) {
                // Directly login the user
                Auth::guard('patients')->login($user);
                $request->session()->regenerate();

                return [
                    'status' => 1,
                    'message' => 'Logged In',
                    'redirectRoute' => route('patient.dashboard')
                ];
            } else {
                return [
                    'status' => 0,
                    'message' => 'Incorrect OTP'
                ];
            }
        } catch (Exception $e) {
            // Log the full exception
            Log::error('OTP Verification Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'status' => 0,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ];
        }
    }
}

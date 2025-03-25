<?php

namespace App\Services;

use App\Models\OtpCode;

class OtpService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function generate($userId)
    {
        $length = 4;
        $expiryMinutes = 5;
        // Invalidate any existing OTP codes
        OtpCode::where('user_id', $userId)
            ->where('used', false)
            ->update(['used' => true]);

        // Generate a new OTP code
        $code = str_pad(rand(0, 9999), $length, '0', STR_PAD_LEFT);

        // Save to database
        $otpCode = OtpCode::create([
            'user_id' => $userId,
            'code' => $code,
            'expires_at' => now()->addMinutes($expiryMinutes),
        ]);

        // Send OTP via notification

        return $otpCode;
    }


    public function validate($user, string $code)
    {
        $otpCode = OtpCode::where('user_id', $user->id)
            ->where('code', $code)
            ->where('used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$otpCode) {
            return false;
        }

        // Mark as used
        $otpCode->used = true;
        $otpCode->save();

        return true;
    }
}

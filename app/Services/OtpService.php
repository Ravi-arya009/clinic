<?php

namespace App\Services;

class OtpService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function generate($phone,$user)
    {
        // Invalidate any existing OTP codes
        OtpCode::where('user_id', $user->id)
            ->where('used', false)
            ->update(['used' => true]);

        // Generate a new OTP code
        $code = str_pad(rand(1, 999999), $length, '0', STR_PAD_LEFT);

        // Save to database
        $otpCode = OtpCode::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => now()->addMinutes($expiryMinutes),
        ]);

        // Send OTP via notification

        return $otpCode;
    }
}

<?php

namespace App\Services;

use Razorpay\Api\Api;
use Exception;

class RazorpayService
{
    protected $api;

    public function __construct()
    {
        $this->api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
    }

    public function createOrder($amount, $currency = 'INR')
    {
        try {
            $order = $this->api->order->create([
                'amount' => $amount * 100, // Amount in paise
                'currency' => $currency,
                'payment_capture' => 1 // Auto-capture payment
            ]);

            return $order;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}

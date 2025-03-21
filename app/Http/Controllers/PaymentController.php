<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RazorpayService;
use App\Models\Payment; // Your Payment model
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    protected $razorpay;

    public function __construct(RazorpayService $razorpay)
    {
        $this->razorpay = $razorpay;
    }

    // Create Razorpay Order
    public function createOrder(Request $request)
    {
        $amount = $request->amount; // Get amount from request
        $order = $this->razorpay->createOrder($amount);

        return response()->json($order);
    }

    // Handle Payment Success (After Razorpay Callback)
    public function paymentSuccess(Request $request)
    {
        // Razorpay response params
        $razorpay_payment_id = $request->razorpay_payment_id;
        $razorpay_order_id = $request->razorpay_order_id;
        $razorpay_signature = $request->razorpay_signature;
        $user_id = $request->user_id;  // Assuming you're passing user_id

        // Verify the payment signature
        if ($this->verifySignature($razorpay_payment_id, $razorpay_order_id, $razorpay_signature)) {
            // Get payment details
            $paymentData = $this->getPaymentDetails($razorpay_payment_id);
            dd($paymentData);
            // Save payment data to database
            // $payment = Payment::create([
            //     'user_id' => $user_id,
            //     'appointment_id' => $request->appointment_id, // Assuming you're passing appointment_id
            //     'razorpay_payment_id' => $paymentData['razorpay_payment_id'],
            //     'razorpay_order_id' => $paymentData['razorpay_order_id'],
            //     'amount' => $paymentData['amount'],
            //     'currency' => $paymentData['currency'],
            //     'status' => $paymentData['status'],
            //     'payment_method' => $paymentData['payment_method'],
            //     'email' => $paymentData['email'],
            //     'contact' => $paymentData['contact'],
            // ]);

            return response()->json(['success' => 'Payment successful!']);
        } else {
            return response()->json(['error' => 'Payment verification failed!'], 400);
        }
    }

    // Verify Razorpay signature
    private function verifySignature($razorpay_payment_id, $razorpay_order_id, $razorpay_signature)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $attributes = [
                'razorpay_order_id' => $razorpay_order_id,
                'razorpay_payment_id' => $razorpay_payment_id,
                'razorpay_signature' => $razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    // Fetch Payment Details from Razorpay
    private function getPaymentDetails($razorpay_payment_id)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            $payment = $api->payment->fetch($razorpay_payment_id);

            return [
                'razorpay_payment_id' => $payment->id,
                'razorpay_order_id' => $payment->order_id,
                'amount' => $payment->amount / 100, // Convert from paise to rupees
                'currency' => $payment->currency,
                'status' => $payment->status,
                'payment_method' => $payment->method,
                'email' => $payment->email,
                'contact' => $payment->contact,
            ];
        } catch (\Exception $e) {
            return null;
        }
    }
}

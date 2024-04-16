<?php

namespace App\Http\Controllers;

use App\Mail\SendOTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function sendOTP($email)
    {
       // $email = $request->input('email');

        // Generate OTP
        $otp = mt_rand(100000, 999999);

        // Store the OTP in cache for later verification
        Cache::put('otp_' . $email, $otp, now()->addMinutes(1));

        // Send OTP via email
        Mail::to($email)->send(new SendOTPMail($otp));

        //return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
       return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
    }

    /*public function verifyOTP(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');

        // Retrieve the stored OTP from cache
      //  $storedOtp = Cache::get('otp_' . $email);

        if ($storedOtp === null) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired OTP'], 422);
        }

        if ($otp == $storedOtp) {
            // Email verified successfully
            Cache::forget('otp_' . $email);
            return response()->json(['success' => true, 'message' => 'Email verified']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP'], 422);
    }*/
}
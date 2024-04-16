<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Mail\SendOTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
class Registercontroller extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        $email=$request->input('email');
        $otp = mt_rand(100000, 999999);

      
      
      Session::put('otp_' . $email, $otp);
        
        Mail::to($email)->send(new SendOTPMail($otp));

        return view('Customer.Otp')->with('email',$email);
      
        
}


public function verifyOTP(Request $request)
{
    $email = $request->input('email');
    $otp = $request->input('otp');
$user=User::where('email',$email)->first();

    // Retrieve the stored OTP from cache
    $storedOtp = Session::get('otp_' . $email);

    if ($storedOtp === null) {
      dd('Invalid or expired OTP');
    }

    if ($otp == $storedOtp) {
        // Email verified successfully
        Session::forget('otp_' . $email);
        $user->status='active';
        $user->email_verified_at=now();
        $user->save();
        dd('Email verified');
    }

dd('Invalid OTP');


}
}
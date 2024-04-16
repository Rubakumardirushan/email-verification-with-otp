<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/send-otp/{email}', [VerificationController::class, 'sendOTP']);
Route::post('/verify-otp', [VerificationController::class, 'verifyOTP']);
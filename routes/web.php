<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\RegisterController;

Route::view('/','Customer.Register');
Route::post('/register',[RegisterController::class,'register']);
Route::post('/verfiy',[RegisterController::class,'verifyOTP']);
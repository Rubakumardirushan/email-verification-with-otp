<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\RegisterController;

Route::view('/','Customer.Register')->middleware('guest');

Route::post('/register',[RegisterController::class,'register'])->middleware('guest');
Route::post('/verfiy',[RegisterController::class,'verifyOTP']);
Route::get('/home', function () {
    return view('welcome');
})->middleware('auth');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->middleware('auth');
Route::post('/diru',[RegisterController::class,'login'])->middleware('guest');
Route::view('/login','Customer.Login')->middleware('guest');
Route::post('/resend',[RegisterController::class ,'resend'])->name('resend');
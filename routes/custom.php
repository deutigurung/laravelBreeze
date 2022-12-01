<?php

use Illuminate\Support\Facades\Route;

Route::name('custom.')->middleware(['guest','throttle:global'])->group(function (){
    //login
    Route::get('login',[\App\Http\Controllers\CustomAuth\LoginController::class,'showLogin'])->name('showLogin');
    Route::post('login',[\App\Http\Controllers\CustomAuth\LoginController::class,'storeLogin'])->name('login');

    //register
    Route::get('register',[\App\Http\Controllers\CustomAuth\RegisterController::class,'showRegister'])->name('showRegister');
    Route::post('register',[\App\Http\Controllers\CustomAuth\RegisterController::class,'storeRegister'])->name('register');

    //password forget
    Route::get('forget-password',[\App\Http\Controllers\CustomAuth\PasswordResetController::class,'create'])
        ->name('password.request');

    Route::post('send-forget-password',[\App\Http\Controllers\CustomAuth\PasswordResetController::class,'store'])
        ->name('password.send');

    //new password
    Route::get('reset-password/{token}',[\App\Http\Controllers\CustomAuth\PasswordResetController::class,'passwordResetCreate'])
        ->name('password.resetCreate');

    Route::post('reset-password',[\App\Http\Controllers\CustomAuth\PasswordResetController::class,'passwordResetStore'])
        ->name('password.resetStore');
});

Route::name('custom.')->middleware('auth')->group(function () {
    //logout
    Route::post('logout',[\App\Http\Controllers\CustomAuth\LoginController::class,'logout'])->name('logout');

    //email verification
    Route::get('email-verify',[\App\Http\Controllers\CustomAuth\EmailVerificationController::class,'verify'])
        ->name('email_verify');
    Route::post('send-email-verification',[\App\Http\Controllers\CustomAuth\EmailVerificationController::class,'sendEmailVerify'])
        ->middleware('throttle:6,1')->name('verification.send');
    Route::get('/email/verify/{id}/{hash}',[\App\Http\Controllers\CustomAuth\EmailVerificationController::class,'verificationVerify'])
        ->middleware(['throttle:6,1'])->name('verification.verify');

});

//password confirmation
Route::get('confirm-password',[\App\Http\Controllers\CustomAuth\PasswordResetController::class,'confirmPassword'])
    ->name('password.confirm');

Route::post('confirm-password',[\App\Http\Controllers\CustomAuth\PasswordResetController::class,'validConfirmPassword'])
    ->middleware('throttle:6,1');

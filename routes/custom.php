<?php

use Illuminate\Support\Facades\Route;

Route::name('custom.')->middleware(['guest','throttle:global'])->group(function (){
    //login
    Route::get('login',[\App\Http\Controllers\CustomAuth\LoginController::class,'showLogin'])->name('showLogin');
    Route::post('login',[\App\Http\Controllers\CustomAuth\LoginController::class,'storeLogin'])->name('login');

    //register
    Route::get('register',[\App\Http\Controllers\CustomAuth\RegisterController::class,'showRegister'])->name('showRegister');
    Route::post('register',[\App\Http\Controllers\CustomAuth\RegisterController::class,'storeRegister'])->name('register');

});

Route::name('custom.')->middleware('auth')->group(function () {
    //logout
    Route::post('logout',[\App\Http\Controllers\CustomAuth\LoginController::class,'logout'])->name('logout');

});

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','emailVerify'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//single action controller
//Route::get('/users',\App\Http\Controllers\UserController::class)->name('users');

Route::middleware(['auth','emailVerify'])->group(function() {
    Route::resource('users',\App\Http\Controllers\UserController::class);

    Route::get('posts/duplicate/{id}',[\App\Http\Controllers\PostController::class,'duplicate'])->name('posts.duplicate');
    Route::resource('posts',\App\Http\Controllers\PostController::class);

});
//require __DIR__.'/auth.php';

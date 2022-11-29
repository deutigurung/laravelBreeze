<?php

namespace App\Http\Controllers\CustomAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function storeLogin(LoginRequest $request) {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function logout(Request $request) {
       auth()->guard('web')->logout();
       $request->session()->invalidate();
       $request->session()->regenerate();

       return redirect('/');
    }
}

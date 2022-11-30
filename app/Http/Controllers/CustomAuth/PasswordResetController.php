<?php

namespace App\Http\Controllers\CustomAuth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function create() {
        return view('auth.forgot-password');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT ? back()->with(['status'=>__($status)])
                        : back()->withErrors(['email' => [__($status)]]);
    }

    public function passwordResetCreate(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function passwordResetStore(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::min(8)->mixedCase()->numbers()],
        ]);

        $status = Password::reset($request->only('email','password','password_confirmation','token'),
         function($user,$password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
         });

        return $status === Password::PASSWORD_RESET ? redirect()->route('custom.showLogin')
            ->with(['status'=>__($status)]) : back()->withErrors(['email' => [__($status)]]);

    }
}

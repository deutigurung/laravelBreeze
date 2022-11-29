<?php

namespace App\Http\Controllers\CustomAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify() {
        return view('auth.verify-email');
    }

    public function sendEmailVerify() {
        $user = auth()->user();
        $user->sendEmailVerification();
        return back()->with('status','verification-link-sent');
    }

    public function verificationVerify(EmailVerificationRequest $request) {
        $user = $request->user();
        if($user->markEmailAsVerified()) {
            event(new Verified($user));
        }
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}

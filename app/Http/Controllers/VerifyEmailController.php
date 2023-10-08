<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    //
    public function verifyemailview (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect()->route("user.reservation");
    }

   public function sendveriication (Request $request) {
        $request->user()->sendEmailVerificationNotification();
     
        return back()->with('message', 'Verification link sent!');
    }

   public function show() {
        return view('auth.verify-email');
    }
}

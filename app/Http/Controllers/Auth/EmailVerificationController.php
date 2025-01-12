<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class EmailVerificationController extends Controller
{
    public function show()
    {
        Log::info('Showing email verification page');
        return Inertia::render('Auth/ConfirmEmail');
    }

    public function verify(Request $request)
    {
        Log::info('Verifying email with code', ['code' => $request->code]);

        $request->validate([
            'code' => 'required|string|size:6',
        ]);

        $user = Auth::user();
        Log::info('Checking verification code', [
            'user_id' => $user->id,
            'submitted_code' => $request->code,
            'stored_code' => $user->verification_code
        ]);

        if ($user->verification_code === $request->code) {
            if ($user->hasVerifiedEmail()) {
                Log::info('User email already verified');
                return redirect()->route('home');
            }

            if ($user->markEmailAsVerified()) {
                Log::info('Email verified successfully');
                event(new Verified($user));
            }

            // Clear the verification code
            $user->forceFill([
                'verification_code' => null,
            ])->save();

            Log::info('Verification code cleared');
            return redirect()->route('home')->with('success', 'Email verified successfully!');
        }

        Log::info('Invalid verification code');
        return back()->withErrors(['code' => 'The verification code is invalid.']);
    }

    public function resend(Request $request)
    {
        Log::info('Resending verification code');
        
        if ($request->user()->hasVerifiedEmail()) {
            Log::info('User already verified');
            return redirect()->route('home');
        }

        $request->user()->sendEmailVerificationNotification();
        Log::info('New verification code sent');

        return back()->with('status', 'verification-link-sent');
    }
} 
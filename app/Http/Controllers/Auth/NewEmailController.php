<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class NewEmailController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->user()->id),
                function ($attribute, $value, $fail) use ($request) {
                    if (strtolower($value) === strtolower($request->user()->email)) {
                        $fail('Het nieuwe e-mailadres moet verschillen van je huidige e-mailadres.');
                    }
                },
            ],
            'email_confirmation' => 'required|same:email',
        ]);

        $user = $request->user();
        
        // Generate verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Update user with new unverified email and verification code
        $user->forceFill([
            'email' => $request->email,
            'email_verified_at' => null,
            'verification_code' => $verificationCode,
        ])->save();

        // Send verification email
        $user->sendEmailVerificationNotification();

        return Redirect::route('verification.notice');
    }
} 
<?php

use App\Models\User;
use Illuminate\Support\Facades\Mail;

public function register(Request $request)
{
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users',
        'mobile' => 'required|regex:/^[0-9]{10}$/',
        'password' => 'required|confirmed|min:6',
    ]);

    $verificationCode = rand(100000, 999999);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'password' => bcrypt($request->password),
        'email_verification_code' => $verificationCode,
    ]);

    Mail::raw("Your verification code is: $verificationCode", function ($message) use ($user) {
        $message->to($user->email)
            ->subject('Email Verification Code');
    });

    return response()->json(['message' => 'Verification code sent to email.']);
}

public function verify(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'verification_code' => 'required|digits:6',
    ]);

    $user = User::where('email', $request->email)
        ->where('email_verification_code', $request->verification_code)
        ->first();

    if (!$user) {
        return response()->json(['message' => 'Invalid verification code.'], 400);
    }

    $user->update(['is_verified' => true, 'email_verification_code' => null]);

    return response()->json(['message' => 'Email verified successfully.']);
}

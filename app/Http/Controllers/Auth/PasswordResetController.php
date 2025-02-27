<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\Member; // Ensure you are using the correct model

class PasswordResetController extends Controller
{
    /**
     * Show the password reset form.
     */
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Handle password reset.
     */
    public function reset(Request $request)
    {
        // Validate request
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:members,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Attempt password reset
        $status = Password::broker('members')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($member, $password) {
                $member->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        // Redirect based on success or failure
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member; // Use the Member model
use Illuminate\Support\Facades\Hash;
use App\Models\Otp; // Use the Otp model
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email', // Adjusted for 'members' table
            'mobile' => 'required|digits:10',
            'password' => 'required|min:6|confirmed', // Ensures password and password_confirmation match
        ]);

        // Save data into the database
        $member = Member::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password), // Securely hash the password
        ]);

        $randomOtp = mt_rand(100000, 999999);
        $expiresAt = now()->addMinutes(5); // Set the OTP expiration time to 5 minutes from now

        Otp::create([
            'otp' => $randomOtp,
            'member_id' => $member->id,
            'expires_at' => $expiresAt,
        ]);

        Mail::raw("Your OTP is: $randomOtp", function ($message) use ($request) {
            $message->to($request->email)->subject('Your OTP');
        });
        $email = $request->email;
        return redirect("/otp-verification/$email");
    }


    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
            'email' => 'required|email',
        ]);

        $otp = Otp::where('otp', $request->otp)->first();

        if (!$otp) {
            return back()->withErrors(['Invalid OTP.']);
        }

        $member = Member::find($otp->member_id);
        $member->is_verified = 1;
        $member->save();
        $otp->delete();
        return redirect('/login')->with('success', 'Account created successfully. Please login.');
    }

    public function showOtpForm($email)
    {
        return view('otp', compact('email'));
    }
}
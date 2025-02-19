<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member; // Use the Member model
use Illuminate\Support\Facades\Hash;
use App\Models\Otp; // Use the Otp model
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;


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
            'password' => 'required|min:8|confirmed', // Ensures password and password_confirmation match
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
    public function updateDetails(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:15',
        ]);

        $user = Auth::user();
        $user->first_name = $request->username;
        $user->email = $request->email;
        $user->mobile = $request->phone;
        $user->save();

        return back()->with('success', 'Details updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);
        //dd($request);

        $user = Auth::user();
        if (!Hash::check($request->input('current-password'), $user->password)) {
            return back()->withErrors(['current-password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->input('new-password'));
        $user->save();

        return back()->with('success', 'Password changed successfully.');
    }

    public function uploadProfile(Request $request)
    {
        $request->validate([
            'profile-image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        if ($request->hasFile('profile-image')) {
            $image = $request->file('profile-image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_images', $imageName);

            // Delete old profile image if exists
            if ($user->profile_image) {
                Storage::delete('public/profile_images/' . $user->profile_image);
            }

            $user->profile_image = $imageName;
            $user->save();
        }

        return back()->with('success', 'Profile image uploaded successfully.');
    }
}
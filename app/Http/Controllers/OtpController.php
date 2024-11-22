<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OtpController extends Controller
{
    // Send OTP to email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generate a random OTP
        $otp = rand(100000, 999999);

        // Save the OTP to the user's record in the database
        $user = User::where('email', $request->email)->first();
        $user->otp = $otp;
        $user->save();

        // Send the OTP to the user's email
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Your OTP Code');
        });

        return response()->json(['success' => true, 'message' => 'OTP sent to your email.']);
    }

    // Verify the OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->otp == $request->otp) {
            // Mark user as verified
            $user->is_verified = true;
            $user->otp = null; // Clear the OTP
            $user->save();

            return response()->json(['success' => true, 'message' => 'OTP verified successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member; // Use your Member model for credentials
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Fetch user data from the database
        $member = Member::where('email', $request->email)->first();

        if (!$member) {
            return back()->withErrors(['email' => 'User does not exist'])->withInput();
        }

        if($member->is_verified == 0){
            return back()->withErrors(['email' => 'User not verified'])->withInput();
        }

        

        // Check if user exists and password matches
        if ($member && Hash::check($request->password, $member->password)) {
            // Start a session for the authenticated user
            session(['user' => $member]);

            // Redirect to portfolio page
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }

        // If authentication fails
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
}
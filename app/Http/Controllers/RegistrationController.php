<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member; // Use the Member model
use Illuminate\Support\Facades\Hash;

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
        Member::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password), // Securely hash the password
        ]);

        // Redirect or respond
        return redirect('/login')->with('success', 'Registration successful!');
    }
}
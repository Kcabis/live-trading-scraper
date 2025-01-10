<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folioadmin;
use Illuminate\Support\Facades\Hash;

class FolioadminController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ]);

        // Save to the database
        $validated['password'] = bcrypt($validated['password']);
        Folioadmin::create($validated);
        return redirect()->back()->with("message", "Admin added successfully.");
    }

    public function index()
    {
        $folioadmins = Folioadmin::all();
        return view('admin', compact("folioadmins"));
    }

    public function delete(Folioadmin $folioadmin)
    {
        $folioadmin->delete();
        return redirect()->back()->with("message", "User deleted successfully.");
    }

    public function loginad(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Special admin credentials
        $specialAdminEmail = 'admin@gmail.com';
        $specialAdminPassword = 'Admin234';

        // Check if credentials match the special admin user
        if ($request->email === $specialAdminEmail && $request->password === $specialAdminPassword) {
            // Start a session for the special admin user
            session(['user' => ['email' => $specialAdminEmail, 'role' => 'super-admin']]);

            // Redirect to admin dashboard
            return redirect()->route('admin')->with('success', 'Login successful!');
        }

        // Fetch user data from the database
        $folioadmins = Folioadmin::where('email', $request->email)->first();

        if (!$folioadmins) {
            return back()->withErrors(['email' => 'User does not exist'])->withInput();
        }

        // Check if user exists and password matches
        if ($folioadmins && Hash::check($request->password, $folioadmins->password)) {
            // Start a session for the authenticated user
            session(['user' => $folioadmins]);

            // Redirect to admin dashboard
            return redirect()->route('admin')->with('success', 'Login successful!');
        }

        // If authentication fails
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folioadmin;
use Illuminate\Support\Facades\Hash;

class FolioadminController extends Controller
{
    //
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
        $validated['password']=bcrypt($validated['password']);
        Folioadmin::create($validated);
        return redirect()->back()->with("message","admin Added Successfully.");

    }
    public function index(){
        $folioadmins = Folioadmin::all();
        return view('admin',compact("folioadmins"));
    }
    public function delete(Folioadmin $folioadmin){
        $folioadmin->delete();
        return redirect()->back()->with("message","User deleted sucessfully.");
    
    }
    public function loginad(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Fetch user data from the database
        $folioadmins= Folioadmin::where('email', $request->email)->first();

        if (!$folioadmins) {
            return back()->withErrors(['email' => 'User does not exist'])->withInput();
        }        

        // Check if user exists and password matches
        if ($folioadmins && Hash::check($request->password, $folioadmins->password)) {
            // Start a session for the authenticated user
            session(['user' => $folioadmins]);

            // Redirect to portfolio page
            return redirect()->route('admin')->with('success', 'Login successful!');
        }

        // If authentication fails
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

}
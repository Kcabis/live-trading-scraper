<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folioadmin;
use Illuminate\Support\Facades\Hash;
use App\Models\Members;
use App\Models\Portfolio;

class FolioadminController extends Controller
{
    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|min:6',
            'role' => 'required|string',
        ]);

      
        $validated['password'] = bcrypt($validated['password']);
        Folioadmin::create($validated);
        return redirect()->back()->with("message", "Admin added successfully.");
    }

    public function index()
    {
        $folioadmins = Folioadmin::all();
        $members = Members::all();
        $portfolios = Portfolio::all();
        return view('admin', compact("folioadmins",'members','portfolios'));
    }

    public function delete(Folioadmin $folioadmin)
    {
        $folioadmin->delete();
        return redirect()->back()->with("message", "User deleted successfully.");
    }

    public function loginad(Request $request)
    {
   
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       
        $specialAdminEmail = 'admin@gmail.com';
        $specialAdminPassword = 'Admin123';

       
        if ($request->email === $specialAdminEmail && $request->password === $specialAdminPassword) {
           
            session(['user' => ['email' => $specialAdminEmail, 'role' => 'super-admin']]);

        
            return redirect()->route('admin')->with('success', 'Login successful!');
        }

      
        $folioadmins = Folioadmin::where('email', $request->email)->first();

        if (!$folioadmins) {
            return back()->withErrors(['email' => 'User does not exist'])->withInput();
        }

       
        if ($folioadmins && Hash::check($request->password, $folioadmins->password)) {
            session(['user' => $folioadmins]);

           
            return redirect()->route('admin')->with('success', 'Login successful!');
        }

        
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
}

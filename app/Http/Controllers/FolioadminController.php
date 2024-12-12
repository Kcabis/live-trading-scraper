<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folioadmin;

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

}
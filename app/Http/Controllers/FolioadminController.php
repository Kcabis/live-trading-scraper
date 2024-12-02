<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folioadmin;

class FolioadminController extends Controller
{
    //
    public function store(Request $request)

    {
    //   dd($request->all());
        // Validate incoming data
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:12',
            'role' => 'required|string',
            
        ]);

        // Save to the database
        Folioadmin::create($validated);
        return redirect()->back()->with("message","admin Added Successfully.");
    }
    public function index(){
        $folioadmins = Folioadmin::all();
        return view('admin',compact("folioadmins"));
    }

}
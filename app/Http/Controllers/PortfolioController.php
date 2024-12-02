<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    // Store a new portfolio
    public function store(Request $request)
    {
        
        
        $validated=$request->validate([
            'portfolio_name' => 'required|string|max:255',
        ]);

        

            // Save to the database
        Portfolio::create($validated);
        return redirect()->back()->with("message","portfolio Added Successfully.");
        dd("fyuv");

    }
    public function index(){
            
        $portfolios= Portfolio::all();
        return view('portfolio',compact("portfolios"));
    }

}

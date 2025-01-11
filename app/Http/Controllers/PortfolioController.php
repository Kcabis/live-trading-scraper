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
        
        $existingPortfolio = Portfolio::where('portfolio_name', $validated['portfolio_name'])->first();

        if ($existingPortfolio) {
            // If the portfolio already exists, redirect with an error message
            return redirect()->back()->with("message", "Portfolio already exists.");
        }

        

            // Save to the database
        Portfolio::create($validated); 
        return redirect()->back()->with("message","portfolio Added Successfully.");
        
        

    }
    public function index(){
            
        $portfolios= Portfolio::all();
        return view('portfolio',compact("portfolios"));
    }
    public function hist(){
        $portfolios= Portfolio::all();
        return view('history',compact("portfolios"));

    }
    public function updatePortfolio(Request $request)
{
    $portfolio = Portfolio::find($request->portfolio_id);
    if ($portfolio) {
        $portfolio->portfolio_name = $request->portfolio_name;
        $portfolio->save();
        return back()->with('success', 'Portfolio updated successfully.');
    }
    return back()->with('error', 'Portfolio not found.');
}
public function deletePortfolio($id)
{
    $portfolio = Portfolio::find($id);
    if ($portfolio) {
        $portfolio->delete();
        return back()->with('success', 'Portfolio deleted successfully.');
    }
    return back()->with('error', 'Portfolio not found.');
}


}

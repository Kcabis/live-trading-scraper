<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Models\Transaction;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'portfolio_name' => 'required|string|max:255',
        ]);
    
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated']);
        }
    
        // Create the portfolio with the authenticated user's ID
        Portfolio::create([
            'member_id' => Auth::id(),  // Ensure the member_id is correctly assigned
            'portfolio_name' => $request->portfolio_name,
        ]);
    
        return redirect()->back()->with('success', 'Portfolio added successfully!');
    }


    
    

    
   
    public function index()
{
   $portfolios = Portfolio::where('member_id', Auth::id())->get();
    return view('dash', compact('portfolios'));
}

public function account()
{
    $portfolios = Portfolio::where('member_id', Auth::id())->get(); // Get portfolio objects
    $transactions = Transaction::whereIn('portfolio_id', $portfolios->pluck('id'))->get(); // Fetch transactions for those portfolios

    return view('account-statement', compact('transactions', 'portfolios'));
}

    

public function hist()
{
    $portfolios = Portfolio::where('member_id', Auth::id())->get();

    // Extract portfolio IDs as an array
    $portfolioIds = $portfolios->pluck('id')->toArray();

    // Fetch transactions related to these portfolios
    $transactions = Transaction::whereIn('portfolio_id', $portfolioIds)->get();

    // Use database aggregation to get total buy and sell amounts
    $totalbuy = Transaction::whereIn('portfolio_id', $portfolioIds)
                           ->where('action', 'buy')
                           ->sum('total_amount');

    $totalsell = Transaction::whereIn('portfolio_id', $portfolioIds)
                            ->where('action', 'sell')
                            ->sum('total_amount');

    $totaltransactions = $totalbuy + $totalsell;

    return view('history', compact("portfolios", "transactions", "totalbuy", "totalsell", "totaltransactions"));
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
    $portfolio = Portfolio::findOrFail($id);

    // Delete related stocks first
    $portfolio->stocks()->delete();

    // Now delete the portfolio
    $portfolio->delete();

    return redirect()->back()->with('success', 'Portfolio deleted successfully!');
}




}

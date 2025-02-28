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
    

        if (!Auth::check()) {
            return redirect()->back()->withErrors(['error' => 'User not authenticated']);
        }
    
     
        Portfolio::create([
            'member_id' => Auth::id(),  
            'portfolio_name' => $request->portfolio_name,
        ]);
    
        return redirect()->back()->with('success', 'Portfolio added successfully!');
    }


    
    

    
   
    public function index()
{
   $portfolios = Portfolio::where('member_id', Auth::id())->get();
    return view('dash', compact('portfolios'));
}

// public function account()
// {
//     $portfolios = Portfolio::where('member_id', Auth::id())->pluck('id'); 

//     $transactions = Transaction::whereIn('portfolio_id', $portfolios)->get();

//     return view('account-statement', compact('transactions', 'portfolios'));
// }
public function account()
{
    $portfolios = Portfolio::where('member_id', Auth::id())->get();


    $portfolioIds = $portfolios->pluck('id')->toArray();

  
    $transactions = Transaction::whereIn('portfolio_id', $portfolioIds)->get();

   
    $totalbuy = Transaction::whereIn('portfolio_id', $portfolioIds)
                           ->where('action', 'buy')
                           ->sum('total_amount');

    $totalsell = Transaction::whereIn('portfolio_id', $portfolioIds)
                            ->where('action', 'sell')
                            ->sum('total_amount');
     $totalquantity = (float) Transaction::whereIn('portfolio_id', $portfolioIds)->sum('quantity');
    

   $totaltransactions = $totalbuy + $totalsell;

    return view('account-statement', compact("portfolios", "transactions", "totalbuy", "totalsell","totalquantity"));
}

    

public function hist()
{
    $portfolios = Portfolio::where('member_id', Auth::id())->get();


    $portfolioIds = $portfolios->pluck('id')->toArray();

  
    $transactions = Transaction::whereIn('portfolio_id', $portfolioIds)->get();

   
    $totalbuy = Transaction::whereIn('portfolio_id', $portfolioIds)
                           ->where('action', 'buy')
                           ->sum('total_amount');

    $totalsell = Transaction::whereIn('portfolio_id', $portfolioIds)
                            ->where('action', 'sell')
                            ->sum('total_amount');

    $totaltransactions = Transaction::whereIn('portfolio_id', $portfolioIds)->sum('total_amount');

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

    $portfolio->stocks()->delete();

    $portfolio->delete();

    return redirect()->back()->with('success', 'Portfolio deleted successfully!');
}




}

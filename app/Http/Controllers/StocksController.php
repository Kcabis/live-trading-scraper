<?php

namespace App\Http\Controllers;
use App\Models\Stocks;

use Illuminate\Http\Request;

class StocksController extends Controller
{
    //
    public function store(Request $request)

    {
    //   dd($request->all());
        // Validate incoming data
        $validated = $request->validate([
            'stockName' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'purchasePrice' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            
        ]);

        // Save to the database
        Stocks::create($validated);

        return redirect()->back()->with("message","Stock Added Successfully.");
    }
    public function index(){
        $stock = Stocks::all();
       
        return view('portfolio',compact("stocks"));
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Stocks;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data including the confirmation data
        $validated = $request->validate([
            'stockName' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'purchasePrice' => 'required|numeric',
            'quantity' => 'required|numeric|min:0',
            'totalAmount' => 'required|numeric',
            'sebonCommission' => 'required|numeric',
            'brokerCommission' => 'required|numeric',
            'dpFee' => 'required|numeric',
            'wacc' => 'required|numeric',
            'totalCost' => 'required|numeric',
        ]);

        // Save to the database
        Stocks::create([
            'stock_name' => $validated['stockName'],
            'type' => $validated['type'],
            'purchase_price' => $validated['purchasePrice'],
            'quantity' => $validated['quantity'],
            'total_amount' => $validated['totalAmount'],
            'sebon_commission' => $validated['sebonCommission'],
            'broker_commission' => $validated['brokerCommission'],
            'dp_fee' => $validated['dpFee'],
            'wacc' => $validated['wacc'],
            'total_cost' => $validated['totalCost'],
        ]);

        return redirect()->back()->with("message", "Stock Added Successfully.");
    }

    public function index()
    {
        $stock = Stocks::all();
       
        return view('portfolio', compact("stock"));
    }
}

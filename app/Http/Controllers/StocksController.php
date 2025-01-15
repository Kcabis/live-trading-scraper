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
            'portfolio_id' => 'required|numeric',
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
            'action' => 'required|string',
        ]);

        
       
        
        // Create a new stock record
        Stocks::create([
            'portfolio_id' => $validated['portfolio_id'],
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
            'action' => $validated['action'],

        ]);

        return redirect()->back()->with("message", "Stock Added Successfully.");
    }
    // Update stock
    public function update(Request $request, $id)
    {
        $stock = Stocks::findOrFail($id);

        // Validate and update stock data
        $validated = $request->validate([
            'stock_name' => 'required|string|max:255',
            'action' => 'required|string',
            'type' => 'required|string',
            'quantity' => 'required|numeric|min:0',
            'purchase_price' => 'required|numeric',
            'total_cost' => 'required|numeric',
        ]);

        $stock->update([
            'stock_name' => $validated['stock_name'],
            'action' => $validated['action'],
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'purchase_price' => $validated['purchase_price'],
            'total_cost' => $validated['total_cost'],
        ]);

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully!');
    }


    public function index()
    {
        $stock = Stocks::all();
       
        return view('portfolio', compact("stock"));
    }
    public function delete(Stocks $stock){
        $stock->delete();
        return redirect()->back()->with("message","Stock deleted sucessfully");
    }
    public function account()
    {
        $stocks = Stocks::all();
        return view('account-statement', compact("stocks"));
    }
   
    
    
}

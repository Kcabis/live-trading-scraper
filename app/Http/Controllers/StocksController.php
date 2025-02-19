<?php

namespace App\Http\Controllers;

use App\Models\Stocks;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Apps\Models\Portfolio;


class StocksController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'portfolio_id' => 'required|numeric',
            'stockName' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'purchasePrice' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'totalAmount' => 'required|numeric',
            'sebonCommission' => 'required|numeric',
            'brokerCommission' => 'required|numeric',
            'dpFee' => 'required|numeric',
            'wacc' => 'required|numeric',
            'totalCost' => 'required|numeric',
            'action' => 'required|string',
        ]);
        
    
        // Check if the stock already exists in the same portfolio
        $existingStock = Stocks::where('portfolio_id', $validated['portfolio_id'])
                               ->where('stock_name', $validated['stockName'])
                               ->first();
    
        if ($existingStock) {
            // Update the existing stock
            $existingStock->quantity += $validated['quantity'];
    
            // Recalculate the weighted average cost (WACC)
            $existingStock->wacc = 
                (($existingStock->wacc * ($existingStock->quantity - $validated['quantity'])) 
                + ($validated['wacc'] * $validated['quantity'])) 
                / $existingStock->quantity;
    
            // Update other fields
            $existingStock->total_amount += $validated['totalAmount'];
            $existingStock->total_cost += $validated['totalCost'];
            $existingStock->sebon_commission += $validated['sebonCommission'];
            $existingStock->broker_commission += $validated['brokerCommission'];
            $existingStock->dp_fee += $validated['dpFee'];
            $existingStock->save();
        } else {
            // Create a new stock record in the correct portfolio
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
        }
    
        // Create a transaction for logging
        Transaction::create([
            'portfolio_id' => $validated['portfolio_id'],
            'stock_name' => $validated['stockName'],
            'action' => 'buy',
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'price' => $validated['purchasePrice'],
            'total_amount' => $validated['totalAmount'],
            'capital_gain_tax' => 0,
            'net_receivable' => 0,
            'profit_loss' => 0,
            'sebon_commission' => $validated['sebonCommission'],
            'broker_commission' => $validated['brokerCommission'],
            'dp_fee' => $validated['dpFee'],
            'wacc' => $validated['wacc'],
            'total_cost' => $validated['totalCost'],
        ]);
    
        return redirect()->back()->with("message", "Stock added successfully.");
    }
    
    public function sellStock(Request $request)
    {
        $validatedData = $request->validate([
            'action' => 'required|string',
            'stockName' => 'required|string',
            'sellingPrice' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|numeric',
            'portfolio_id' => 'required|numeric',
        ]);
        //dd($validatedData);
    
        // Find the stock by stock name and portfolio ID
        $stock = Stocks::where('portfolio_id', $validatedData['portfolio_id'])
                       ->where('stock_name', $validatedData['stockName'])
                       ->first();
    
        if (!$stock || $stock->quantity < $validatedData['quantity']) {
            return back()->with('error', 'Not enough quantity available to sell or stock not found in this portfolio.');
        }
    
        // Calculate selling amount and profit/loss
        $sellingPrice = $validatedData['sellingPrice'];
        $quantity = $validatedData['quantity'];
        $totalAmount = $sellingPrice * $quantity;
        $totalCost = $stock->wacc * $quantity;
        $profitLoss = $totalAmount - $totalCost;
        $seboncomission=($totalAmount*0.015)/100;
        $brokercomission=$this->calculateBrokerCommission($totalAmount);
    
        // Capital Gains Tax (CGT)
        $cgt = $profitLoss > 0 ? $profitLoss * ($validatedData['type'] / 100) : 0;
        $netReceivable = $totalAmount - $cgt;
    
        // Reduce stock quantity and adjust total cost
        $stock->quantity -= $quantity;
        $stock->total_cost -= $totalCost;
    
        // Reset WACC if no stock left
        // if ($stock->quantity == 0) {
        //     $stock->wacc = 0;
        // }
        $stock->save();
    
        // Ensure transaction data is correctly saved
        $transaction = Transaction::create([
            'portfolio_id' => $stock->portfolio_id,
            'stock_name' => $validatedData['stockName'],
            'action' => 'sell',
            'type' => 'secondary',
            'quantity' => $quantity,
            'price' => $sellingPrice,
            'total_amount' => $totalAmount,
            'cgt' => $cgt,  // Corrected field name
            'net_receivable' => $netReceivable,
            'profit_loss' => $profitLoss,
            'sebon_commission' => $seboncomission,
            'broker_commission' => $brokercomission,
            'dp_fee' => 25,
            'wacc' => $stock->wacc,
            'total_cost' => $stock->total_cost,
        ]);
    
        if (!$transaction) {
            return back()->with('error', 'Transaction record not saved.');
        }
    
        return redirect()->route('dashboard')->with('success', 'Stock sold successfully!');
    }

    // Function to Calculate Broker Commission
private function calculateBrokerCommission($totalAmount)
{
    if ($totalAmount <= 2500) {
        return 10; // Fixed fee
    } elseif ($totalAmount <= 50000) {
        return $totalAmount * 0.36 / 100;
    } elseif ($totalAmount <= 500000) {
        return $totalAmount * 0.33 / 100;
    } elseif ($totalAmount <= 2000000) {
        return $totalAmount * 0.31 / 100;
    } else {
        return $totalAmount * 0.27 / 100;
    }
}
    
    


    public function sell($id)
    {
        $stock = Stocks::findOrFail($id); // Fetch stock details by ID
        $symbols = Stocks::pluck('stock_name'); // Fetch all stock names (if needed)
        
        return view('sell', compact('stock', 'symbols'));
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
 

       // Edit Stock
    public function edit($id)
    {
        $stock = Stocks::findOrFail($id);
        return view('edit', compact('stock'));
    }

    // Update Stock
    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'action' => 'required|string',
            'stockName' => 'required|string',
            'type' => 'required|string',
            'purchasePrice' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'totalAmount' => 'required|numeric',
            'sebonCommission' => 'required|numeric',
            'brokerCommission' => 'required|numeric',
            'dpFee' => 'required|numeric',
            'wacc' => 'required|numeric',
            'totalCost' => 'required|numeric',
            'netPayable' => 'nullable|numeric',
            'netReceivable' => 'nullable|numeric',
        ]);

        // Find the stock by ID
        $stock = Stocks::findOrFail($id);

        // Update stock details
        $stock->action = $validated['action'];
        $stock->stock_name = $validated['stockName'];
        $stock->type = $validated['type'];
        $stock->wacc = $validated['wacc'];
        $stock->quantity = $validated['quantity'];
        $stock->total_amount = $validated['totalAmount'];
        $stock->sebon_commission = $validated['sebonCommission'];
        $stock->broker_commission = $validated['brokerCommission'];
        $stock->dp_fee = $validated['dpFee'];
        $stock->total_cost = $validated['totalCost'];

        // Calculate additional fields
        if ($validated['action'] === 'buy') {
            $stock->net_payable = $validated['netPayable'] ?? ($validated['totalAmount'] + $validated['sebonCommission'] + $validated['brokerCommission'] + $validated['dpFee']);
        } elseif ($validated['action'] === 'sell') {
            $stock->net_receivable = $validated['netReceivable'] ?? ($validated['totalAmount'] - ($validated['totalAmount'] * 0.05)); // Assuming 5% tax
        }

        $stock->save();

        // Update Transactions Table
        $transaction = Transactions::where('stock_name', $validated['stockName'])->first();
        if ($transaction) {
            $transaction->action = $validated['action'];
            $transaction->price = $validated['purchasePrice'];
            $transaction->quantity = $validated['quantity'];
            $transaction->total_amount = $validated['totalAmount'];
            $transaction->capital_gain_tax = $validated['action'] === 'sell' ? ($validated['totalAmount'] * 0.05) : 0;
            $transaction->net_receivable = $stock->net_receivable ?? 0;
            $transaction->net_payable = $stock->net_payable ?? 0;
            $transaction->profit_loss = $transaction->net_receivable - ($validated['purchasePrice'] * $validated['quantity']);
            $transaction->save();
        }

        return redirect()->route('history')->with('success', 'Stock updated successfully!');
    }



      //trader analytics section data
      public function getStocksData()
{
    // Fetch the stock names and total amounts from the Stocks table
    $stocks = Stocks::select('stock_name', 'total_amount')->get();

    // Return the data as JSON
    return response()->json($stocks);
}
   
    
    
}

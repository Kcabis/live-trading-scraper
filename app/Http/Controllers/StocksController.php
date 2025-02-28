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
        
    
        $existingStock = Stocks::where('portfolio_id', $validated['portfolio_id'])
                               ->where('stock_name', $validated['stockName'])
                               ->first();
    
        if ($existingStock) {
            $existingStock->quantity += $validated['quantity'];
    
            $existingStock->wacc = 
                (($existingStock->wacc * ($existingStock->quantity - $validated['quantity'])) 
                + ($validated['wacc'] * $validated['quantity'])) 
                / $existingStock->quantity;
    
            
            $existingStock->total_amount += $validated['totalAmount'];
            $existingStock->total_cost += $validated['totalCost'];
            $existingStock->sebon_commission += $validated['sebonCommission'];
            $existingStock->broker_commission += $validated['brokerCommission'];
            $existingStock->dp_fee += $validated['dpFee'];
            $existingStock->save();
        } else {
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
    
        $stock = Stocks::where('portfolio_id', $validatedData['portfolio_id'])
                       ->where('stock_name', $validatedData['stockName'])
                       ->first();
    
        if (!$stock || $stock->quantity < $validatedData['quantity']) {
            return back()->with('error', 'Not enough quantity available to sell or stock not found in this portfolio.');
        }
    
        $sellingPrice = $validatedData['sellingPrice'];
        $quantity = $validatedData['quantity'];
        $totalAmount = $sellingPrice * $quantity;
        $totalCost = $stock->wacc * $quantity;
        $profitLoss = $totalAmount - $totalCost;
        $seboncomission=($totalAmount*0.015)/100;
        $brokercomission=$this->calculateBrokerCommission($totalAmount);
    
        $cgt = $profitLoss > 0 ? $profitLoss * ($validatedData['type'] / 100) : 0;
        $netReceivable = $totalAmount - $cgt;
    
        $stock->quantity -= $quantity;
        $stock->total_cost -= $totalCost;
    
        $stock->save();
    
        $transaction = Transaction::create([
            'portfolio_id' => $stock->portfolio_id,
            'stock_name' => $validatedData['stockName'],
            'action' => 'sell',
            'type' => 'secondary',
            'quantity' => $quantity,
            'price' => $sellingPrice,
            'total_amount' => $totalAmount,
            'cgt' => $cgt, 
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

private function calculateBrokerCommission($totalAmount)
{
    if ($totalAmount <= 2500) {
        return 10;
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
        $stock = Stocks::findOrFail($id); 
        $symbols = Stocks::pluck('stock_name'); 
        
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
 

    public function edit($id)
    {
        $stock = Stocks::findOrFail($id);
        return view('edit', compact('stock'));
    }

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

    // Find the transaction being edited
    $transaction = Transaction::findOrFail($id);

    // Store the original quantity before updating
    $originalQuantity = $transaction->quantity;
    $originalAction = $transaction->action;

    // Update the transaction details
    $transaction->action = $validated['action'];
    $transaction->price = $validated['purchasePrice'];
    $transaction->quantity = $validated['quantity'];
    $transaction->total_amount = $validated['totalAmount'];
    $transaction->capital_gain_tax = $validated['action'] === 'sell' ? ($validated['totalAmount'] * 0.05) : 0;
    $transaction->net_receivable = $validated['netReceivable'] ?? 0;
    $transaction->net_payable = $validated['netPayable'] ?? 0;
    $transaction->profit_loss = $transaction->net_receivable - ($validated['purchasePrice'] * $validated['quantity']);
    $transaction->save();

    // Find the stock in the portfolio
    $stock = Stocks::where('portfolio_id', $transaction->portfolio_id)
                   ->where('stock_name', $validated['stockName'])
                   ->first();

    // If stock exists, recalculate its quantity and other values
    if ($stock) {
        // Recalculate total quantity by fetching total buy and sell transactions
        $totalBuyQuantity = Transaction::where('portfolio_id', $transaction->portfolio_id)
                                       ->where('stock_name', $validated['stockName'])
                                       ->where('action', 'buy')
                                       ->sum('quantity');

        $totalSellQuantity = Transaction::where('portfolio_id', $transaction->portfolio_id)
                                        ->where('stock_name', $validated['stockName'])
                                        ->where('action', 'sell')
                                        ->sum('quantity');

        // New final quantity
        $finalQuantity = $totalBuyQuantity - $totalSellQuantity;

        // Update stock with corrected quantity and totals
        $stock->quantity = $finalQuantity;
        $stock->wacc = $validated['wacc'];
        $stock->total_amount = Transaction::where('portfolio_id', $transaction->portfolio_id)
                                          ->where('stock_name', $validated['stockName'])
                                          ->sum('total_amount');

        $stock->total_cost = Transaction::where('portfolio_id', $transaction->portfolio_id)
                                        ->where('stock_name', $validated['stockName'])
                                        ->sum('total_cost');

        $stock->sebon_commission = Transaction::where('portfolio_id', $transaction->portfolio_id)
                                              ->where('stock_name', $validated['stockName'])
                                              ->sum('sebon_commission');

        $stock->broker_commission = Transaction::where('portfolio_id', $transaction->portfolio_id)
                                               ->where('stock_name', $validated['stockName'])
                                               ->sum('broker_commission');

        $stock->dp_fee = Transaction::where('portfolio_id', $transaction->portfolio_id)
                                    ->where('stock_name', $validated['stockName'])
                                    ->sum('dp_fee');

        $stock->save();
    }

    return redirect()->route('history')->with('success', 'Transaction updated successfully and stock quantity updated.');
}




      public function getStocksData()
{
    $stocks = Stocks::select('stock_name', 'total_amount')->get();

    return response()->json($stocks);
}
   
    
    
}

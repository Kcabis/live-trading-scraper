<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Portfolio;
use App\Models\Stocks;

use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display the history of transactions.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $portfolios = Portfolio::where('member_id', $userId)->get();
        $portfolioIds = $portfolios->pluck('id')->toArray();
    
        $portfolio_id = $request->query('portfolio_id');
    
        $transactions = Transaction::whereIn('portfolio_id', $portfolioIds)
        ->when($portfolio_id, function ($query) use ($portfolio_id) {
        return $query->where('portfolio_id', $portfolio_id); }) ->get();

        
                
    
        return view('ind-history', compact('transactions', 'portfolios'));
    }
    

    /**
     * Show the form for editing a specific transaction.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('edit', compact('transaction'));
    }

    /**
     * Update a specific transaction.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|string',
            'stockName' => 'required|string',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'totalAmount' => 'required|numeric',
            'capitalGainTax' => 'required|numeric',
            'netReceivable' => 'required|numeric',
            'profitLoss' => 'required|numeric',
            'wacc' => 'required|numeric',
            'netPayable' => 'required|numeric',
        ]);
    

        $transaction = Transaction::findOrFail($id);
        $transaction->action = $request->action;
        $transaction->stock_name = $request->stockName;
        $transaction->type = $request->type;
        $transaction->price = $request->price;
        $transaction->quantity = $request->quantity;
        $transaction->total_amount = $request->totalAmount;
        $transaction->cgt = $request->capitalGainTax;
        $transaction->net_receivable = $request->netReceivable;
        $transaction->profit_loss = $request->profitLoss;
        $transaction->wacc = $request->wacc;
        $transaction->total_cost = $request->netPayable;
        $transaction->save();

        $stock = Stocks::where('stock_name', $request->stockName)->first();
        
        if ($stock) {
            if ($request->action == 'buy') {
                $stock->quantity += $request->quantity;
            } else {
                $stock->quantity -= $request->quantity;
            }
            $stock->save();
        }
        

        return redirect()->route('history')->with('success', 'Transaction updated successfully.');
    }




    /**
     * Delete a specific transaction.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        
    
        if ($transaction->action == 'buy') {
            $stock = Stocks::where('portfolio_id', $transaction->portfolio_id)
                ->where('stock_name', $transaction->stock_name)
                ->first();
    
            if ($stock) {
                $stock->quantity -= $transaction->quantity;
                $stock->total_cost -= ($transaction->price * $transaction->quantity);
    
                if ($stock->quantity == 0) {
                    $stock->wacc = 0;
                }
    
                $stock->save();
            }
        }
    
        $transaction->delete();
    
        return redirect()->route('history')
            ->with('success', 'Transaction deleted successfully.');
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'portfolio_data' => 'required|array',
        ]);

        // Create a new AmedPortfolio record
        $portfolio = Portfolio::create([
            'name' => $validated['name'],
            'portfolio_data' => json_encode($validated['portfolio_data']), // Convert portfolio data to JSON
        ]);

        // Return a response, you can redirect or return JSON
        return response()->json(['message' => 'Portfolio saved successfully!', 'portfolio' => $portfolio]);
    }
}

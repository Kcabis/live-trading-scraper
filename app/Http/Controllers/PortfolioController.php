<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    // Store a new portfolio
    public function savePortfolio(Request $request)
    {
        $request->validate([
            'shareholder_name' => 'required|string|max:255',
        ]);

        $portfolio = Portfolio::create([
            'shareholder_name' => $request->shareholder_name,
        ]);

        return response()->json([
            'message' => 'Portfolio created successfully!',
            'portfolio' => $portfolio,
        ]);
    }

    // Get all portfolios
    public function getAllPortfolios()
    {
        $portfolios = Portfolio::all();

        return response()->json($portfolios);
    }

    // Get a single portfolio by ID
    public function getPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        return response()->json([
            'portfolio' => $portfolio,
        ]);
    }
}

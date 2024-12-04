<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Portfolio;

class Dashboardcontroller extends Controller
{
    public function index()
    {
        $portfolios= Portfolio::all(); // Fetch events from EventController logic
        $events=Event::all();
        return view('portfolio', compact('portfolios','events')); // Pass data to the view
    }
}

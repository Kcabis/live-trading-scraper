<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'eventName' => 'required|string|max:255',
            'stockName' => 'required|string|max:255',
            'eventType' => 'required|string',
            'eventPrice' => 'required|numeric|min:0',
            'eventDate' => 'required|date',
        ]);

        // Save to the database
        Event::create([
            'event_name' => $request->input('eventName'),
            'stock_name' => $request->input('stockName'),
            'event_type' => $request->input('eventType'),
            'price' => $request->input('eventPrice'),
            'event_date' => $request->input('eventDate'),
        ]);

        return response()->json(['message' => 'Event added successfully!'], 201);
    }
}

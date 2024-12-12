<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function store(Request $request)

    {
    //   dd($request->all());
        // Validate incoming data
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'stock_name' => 'required|string|max:255',
            'event_type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'event_date' => 'required|date',
        ]);

        // Save to the database
        Event::create($validated);

        return redirect()->back()->with("message","Event Added Successfully.");
    }
    public function index(){
        $events = Event::all();
       
        return view('admin',compact("events"));
    }
    public function delete(Event $event){
        $event->delete();
        return redirect()->back()->with("message","Event deleted sucessfully");
    }
}


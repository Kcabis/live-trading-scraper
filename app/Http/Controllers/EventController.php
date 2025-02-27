<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function store(Request $request)

    {
   
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'stock_name' => 'required|string|max:255',
            'event_type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'event_date' => 'required|date',
        ]);

     
        Event::create($validated);

        return redirect()->back()->with("message","Event Added Successfully.");
    }
    public function index(){
        $events = Event::all();
        return view('admin',compact("events"));
    }
    public function evnt()
    {
        $events = Event::all();
        return view('events', compact('events'));
    }


    public function delete(Event $event){
        $event->delete();
        return redirect()->back()->with("message","Event deleted sucessfully");
    }
    public function edit(Event $event)
    {
        return view('event-edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        // Validate the request data
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'stock_name' => 'required|string|max:255',
            'event_type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'event_date' => 'required|date',
        ]);

        // Update the event
        $event->update($validated);

        // Redirect back with success message
        return redirect()->route('admin')->with('message', 'Event updated successfully.');
    }
}


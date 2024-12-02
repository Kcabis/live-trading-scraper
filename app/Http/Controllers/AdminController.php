<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Folioadmin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $events = Event::all(); // Fetch events from EventController logic
        $folioadmins = Folioadmin::all(); // Fetch data from FolioadminController logic

        return view('admin', compact('events', 'folioadmins')); // Pass data to the view
    }
}

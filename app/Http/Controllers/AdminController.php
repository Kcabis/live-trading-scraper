<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Folioadmin;
use Illuminate\Http\Request;
use App\Models\ListedSecurity;

class AdminController extends Controller
{
    public function index()
    {
        $events = Event::all(); // Fetch events from EventController logic
        $folioadmins = Folioadmin::all(); // Fetch data from FolioadminController logic
        $securities = ListedSecurity::all();

        return view('admin', compact('events', 'folioadmins','securities')); // Pass data to the view
    }
}

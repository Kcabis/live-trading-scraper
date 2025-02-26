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
        $events = Event::all(); 
        $folioadmins = Folioadmin::all();
        $securities = ListedSecurity::all();

        return view('admin', compact('events', 'folioadmins','securities')); 
    }
}

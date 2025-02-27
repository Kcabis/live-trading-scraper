<?php
namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Folioadmin;
use Illuminate\Http\Request;
use App\Models\ListedSecurity;
use App\Models\Member;
use App\Models\Portfolio;
use App\Models\Stocks;

class AdminController extends Controller
{
    public function index()
    {
        $events = Event::all(); 
        $folioadmins = Folioadmin::all();
        $securities = ListedSecurity::all();
        $members = Member::all();
        $users=$members->count();
    
    // Ensure the variable is initialized
    $usersData = [];

    foreach ($members as $member) {
        // Get all portfolios belonging to this member
        $portfolios = Portfolio::where('member_id', $member->id)->get();
        

        // Ensure portfolios exist before counting
        $portfolioCount = $portfolios ? $portfolios->count() : 0;

        // Ensure stocks exist before summing total cost
        $totalInvestment = $portfolios->isNotEmpty() 
            ? Stocks::whereIn('portfolio_id', $portfolios->pluck('id'))->sum('total_cost') 
            : 0;

        // Store data for each user
        $usersData[] = [
            'id' => $member->id,
            'name' => $member->first_name . ' ' . $member->last_name, // Adjust based on your column names
            'portfolio_count' => $portfolioCount,
            'total_investment' => $totalInvestment,
            'email' => $member->email,
        ];
    }

        return view('admin', compact('events', 'folioadmins','securities','usersData','users')); 
    }
}
    


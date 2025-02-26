<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Portfolio;
use GuzzleHttp\Client;
use App\Models\Stocks;
use App\MOdels\ListedSecurity;
use App\Models\Transaction;

use Illuminate\Support\Facades\Auth;

class Dashboardcontroller extends Controller
{
    public function index(Request $request)
{   
    $portfolio_id = $request->query('portfolio_id');
    
    // Fetch all portfolios
    $portfolios = Portfolio::where('member_id', Auth::id())->get();
    // Fetch stocks related to the selected portfolio
    $stocks = $this->getStocksWithLTPfromMerolagani($portfolio_id);
    
    // Get all stock symbols (assuming you have a scraping function)
    $symbols = $this->scrape();
    
    // Get total portfolio value and stock count for each portfolio
    $portfolioData = [];
    
    foreach ($portfolios as $portfolio) {
        // Fetch all stocks related to this portfolio
        $portfolioStocks = Stocks::where('portfolio_id', $portfolio->id)->get();
        $portfolioTransaction = Transaction::where('portfolio_id', $portfolio->id)->get();


        $totalValue = 0;
        $totalStocks = 0;
        $investment=0;
        $current_units=0;
        $soldunits=0;
        $total_profit_loss=0;

        // Calculate the total value and number of stocks for this portfolio
        foreach ($portfolioStocks as $stock) {
            $totalValue += $stock->total_amount; // Assuming total_amount represents the stock value
            $totalStocks += $stock->quantity;  // Summing the number of stocks
           

        }
        foreach($portfolioTransaction as $transaction){
            $action=$transaction->action;
            $quantity=$transaction->quantity;
            if($action=="sell"){
                $soldunits+=$quantity;
            }
            $total_profit_loss+=$transaction->profit_loss;
            $investment+=$transaction->total_cost;
        }

        $portfolioData[] = [
            'id'=>$portfolio->id,
            'name' => $portfolio->portfolio_name,
            'total_value' => $totalValue,
            'total_stocks' => $totalStocks,
            'investment'=>$investment,
            'soldunits'=>$soldunits,
            'total_profit_loss'=>$total_profit_loss,
            'market_value'=>$totalValue,
        ];
    }

    // Pass all data to the view
    return view('dash', compact('portfolios', 'symbols', 'stocks', 'portfolioData')); 
}

  
    //sending stocks to history
    public function history(Request $request)
    {

    $portfolio_id = $request->query('portfolio_id');
        $stocks=Stocks::where('portfolio_id',$portfolio_id)->get();
    $portfolios= Portfolio::where('member_id',Auth::id())->get;
        return view('ind-history',compact('stocks','portfolios'));
    }

   public function listed( Request $request)
   {
    $securities = ListedSecurity::all();
    return view('listedsecurities',compact('securities'));

   }
   public function events( Request $request)
   {
    $events = Event::all();
    return view('events',compact('events'));

   }
   //sending data to port
   public function indexx(Request $request){

    $portfolio_id = $request->query('portfolio_id');
    $portfolios= Portfolio::where('member_id',Auth::id())->get(); // Fetch events from EventController logic
   // $events=Event::all();
    $stocks= $this->getStocksWithLTPfromMerolagani($portfolio_id);
    $symbols = $this->scrape();
    $portfolioTransaction = Transaction::where('portfolio_id', $portfolio_id)->get();
    $total_profit_loss=0;
    // $securities = ListedSecurity::all()  ;
    foreach($portfolioTransaction as $transaction){
        $total_profit_loss+=$transaction->profit_loss;
        
    }

    $portfoliovalue=30;
    return view('port', compact('portfolios', 'symbols' , 'stocks','portfoliovalue','total_profit_loss')); // Pass data to the view
   }

    public function scrape()
    {
        $client = new Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ]
        ]);
        $response = $client->get('https://merolagani.com/LatestMarket.aspx');
        $html = $response->getBody()->getContents();

        if (!$html) {
            return response()->json(['error' => 'Failed to fetch the page content'], 500);
        }

        libxml_use_internal_errors(true); // Enable internal error handling
        $dom = new \DOMDocument();
        $dom->loadHTML($html); // Suppress warnings due to malformed HTML

        $xpath = new \DOMXPath($dom);
        $rows = $xpath->query('//table[contains(@class, "table")][1]/tbody/tr');

        $data = [];
        foreach ($rows as $row) {
            $columns = $row->getElementsByTagName('td');
            if ($columns->length >= 9){
                $symbol = trim($columns->item(0)->textContent);
                $data[] = [
                    'symbol' => $symbol,
                ];
                    }   
                }
        
                $data = array_map(function($value) {
                    return $value['symbol'];
                }, $data);

                return $data;   

            }


            public function getStocksWithLTPfromMerolagani($portfolio_id)
            {
                $stocks = Stocks::where('portfolio_id', $portfolio_id)->get();
                if ($stocks->isEmpty()) {
                    return $stocks;
                }
            
                $client = new Client([
                    'headers' => [
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                    ]
                ]);
            
                $response = $client->get('https://merolagani.com/LatestMarket.aspx');
                $html = $response->getBody()->getContents();
            
                if (!$html) {
                    return response()->json(['error' => 'Failed to fetch the page content'], 500);
                }
            
                libxml_use_internal_errors(true); // Enable internal error handling
                $dom = new \DOMDocument();
                $dom->loadHTML($html); // Suppress warnings due to malformed HTML
                $xpath = new \DOMXPath($dom);
            
                $rows = $xpath->query('//table[contains(@class, "table")][1]/tbody/tr');
            
                $data = [];
            
                foreach ($rows as $row) {
                    $columns = $row->getElementsByTagName('td');
                    if ($columns->length >= 9) {
                        $symbol = trim($columns->item(0)->textContent);
                        $ltp = trim($columns->item(1)->textContent);
                        $data[$symbol] = $ltp; // Use symbol as key for quick lookup
                    }
                }
            
                // Group and aggregate stocks
$groupedStocks = $stocks->groupBy('stock_name')->map(function ($group, $stockName) use ($data) {
    $totalQuantity = $group->sum('quantity');
    $totalAmount = $group->sum('total_amount');
    $totalSebonCommission = $group->sum('sebon_commission');
    $totalBrokerCommission = $group->first()->broker_commission;
    $totalDpFee = $group->sum('dp_fee');
    $totalCost = $group->sum('total_cost');
    $ltp = $data[$stockName] ?? 0; // Get LTP from scraped data if available

    // Calculate weighted average cost if totalQuantity > 0
    $totalWacc = $totalQuantity > 0
        ? $group->sum(function ($stock) use ($totalQuantity) {
            return ($stock->quantity * $stock->wacc) / $totalQuantity;
        })
        : 0;

    return [
        'id' => $group->first()->id,
        'stock_name' => $stockName,
        'quantity' => $totalQuantity,
        'wacc' => $totalWacc,
        'total_amount' => $totalAmount,
        'sebon_commission' => $totalSebonCommission,
        'broker_commission' => $totalBrokerCommission,
        'dp_fee' => $totalDpFee,
        'total_cost' => $totalCost,
        'ltp' => $ltp,
    ];
});

                return $groupedStocks->values(); // Return grouped stocks as an array
            }



            public function analytics()
            {
                $portfolios = Auth::user()->portfolios; // Get all portfolios for the user
            
                if ($portfolios->isEmpty()) {
                    return redirect()->back()->with('error', 'No portfolios found.');
                }
            
                $portfolioData = []; // Array to store portfolio analytics
            
                foreach ($portfolios as $portfolio) {
                    $transactions = Transaction::where('portfolio_id', $portfolio->id)->get();
                    $total_investment=0;
            
                    $winning_trades = $transactions->where('profit_loss', '>', 0)->count();
                    $losing_trades = $transactions->where('profit_loss', '<', 0)->count();
                    $total_trades = $transactions->count();
                    $total_investment = $transactions->sum('total_cost'); 
                    $total_profit = $transactions->where('profit_loss', '>', 0)->sum('profit_loss');
                    $total_loss = $transactions->where('profit_loss', '<', 0)->sum('profit_loss');
                    $roi = $total_investment > 0 ? ($total_profit / $total_investment) * 100 : 0;
                    if ($roi <= 0) {
                        $status = "very poor";
                    } elseif ($roi > 0 && $roi <= 10) {
                        $status = "poor";
                    } elseif ($roi > 10 && $roi <= 20) {
                        $status = "average";
                    } elseif ($roi > 20 && $roi <= 30) {
                        $status = "good";
                    } elseif ($roi > 30 && $roi <= 40) {
                        $status = "very good";
                    } else { // Covers $roi > 40 and other cases
                        $status = "excellent";
                    }
                    

                    $avg_profit = $winning_trades > 0 ? $total_profit / $winning_trades : 0;
                    $avg_loss = $losing_trades > 0 ? $total_loss / $losing_trades : 0;
            
                    // Store calculated data for each portfolio
                    $portfolioData[] = [
                        'portfolio_name' => $portfolio->portfolio_name,
                        'winning_trades' => $winning_trades,
                        'losing_trades' => $losing_trades,
                        'total_trades' => $total_trades,
                        'roi' => number_format($roi, 2),
                        'avg_profit' => number_format($avg_profit, 2),
                        'avg_loss' => number_format($avg_loss, 2),
                        'status' => $status,
                    ];
                }
            
                return view('trader-analytics', compact('portfolioData'));
            }
            
            


            public function settings()
            {
                return view('settings');
            }
            



}
    

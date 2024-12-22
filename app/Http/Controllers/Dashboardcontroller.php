<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Portfolio;
use GuzzleHttp\Client;
use App\Models\Stocks;
use App\MOdels\ListedSecurity;

class Dashboardcontroller extends Controller
{
    public function index(Request $request)
    {   
        $portfolio_id = $request->query('portfolio_id');
        $portfolios= Portfolio::all(); // Fetch events from EventController logic
       // $events=Event::all();
        $stocks= $this->getStocksWithLTPfromMerolagani($portfolio_id);
        $symbols = $this->scrape();
        // $securities = ListedSecurity::all();
        return view('dash', compact('portfolios', 'symbols' , 'stocks')); // Pass data to the view
        
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
    $portfolios= Portfolio::all(); // Fetch events from EventController logic
   // $events=Event::all();
    $stocks= $this->getStocksWithLTPfromMerolagani($portfolio_id);
    $symbols = $this->scrape();
    // $securities = ListedSecurity::all();
    return view('port', compact('portfolios', 'symbols' , 'stocks')); // Pass data to the view

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


    public function getStocksWithLTPfromMerolagani($portfolio_id){
       
        $stocks = Stocks::where('portfolio_id', $portfolio_id)->get();
        if($stocks->isEmpty()){
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
            if ($columns->length >= 9){
                $symbol = trim($columns->item(0)->textContent);
                $ltp = trim($columns->item(1)->textContent);
                $data[] = [
                    'symbol' => $symbol,
                    'ltp' => $ltp
                ];
            }
        }


        $stocks = $stocks->map(function($stock) use ($data){
            $stock->ltp = 0;
            foreach($data as $d){
                if($stock->stock_name == $d['symbol']){
                    $stock->ltp = $d['ltp'];
                }
            }
            return $stock;
        });
        return $stocks;
    }



}
    

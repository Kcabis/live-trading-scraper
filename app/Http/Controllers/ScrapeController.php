<?php


namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ScrapeController extends Controller
{
    public function scrape()
    {
        // Create a Guzzle HTTP client with headers
        $client = new Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ]
        ]);
        $response = $client->get('https://merolagani.com/LatestMarket.aspx');
        $html = $response->getBody()->getContents();

        // Check if the content is valid
        if (!$html) {
            return response()->json(['error' => 'Failed to fetch the page content'], 500);
        }

        // Load HTML content into DOMDocument
        libxml_use_internal_errors(true); // Enable internal error handling
        $dom = new \DOMDocument();
        $dom->loadHTML($html); // Suppress warnings due to malformed HTML

        // Use DOMXPath to navigate and extract data
        $xpath = new \DOMXPath($dom);
        $rows = $xpath->query('//table[contains(@class, "table")][1]/tbody/tr');

        // Initialize an array to store the scraped data
        $data = [];
        foreach ($rows as $row) {
            $columns = $row->getElementsByTagName('td');
            if ($columns->length >= 9){
                $symbol = trim($columns->item(0)->textContent);
                $ltp = trim($columns->item(1)->textContent);
                $change = trim($columns->item(2)->textContent);
                $open = trim($columns->item(3)->textContent);
                $high = trim($columns->item(4)->textContent);
                $low = trim($columns->item(5)->textContent);
                $qty = trim($columns->item(6)->textContent);
                // $pclose = trim($columns->item(7)->textContent);
                // $diff = trim($columns->item(8)->textContent);
                
                
                // Add data to the array
                $data[] = [
                    'symbol' => $symbol,
                    'ltp' => $ltp,
                    'change'=>$change,
                    'open'=>$open,
                    'high' => $high,
                    'low' => $low,
                    'qty'=>$qty,
                    // 'pclose'=>$pclose,
                    // 'diff'=>$diff
                ];
            }
        }

        // Pass the scraped data to the Blade view
        return view('scrapedData', ['data' => $data]);

    }
}

<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ScrapeController extends Controller
{
    public function scrape()
    {
        // Create a Guzzle HTTP client
        $client = new Client();
        $response = $client->get('https://merolagani.com/LatestMarket.aspx');
        $html = $response->getBody()->getContents();

        // Load HTML content into DOMDocument
        $dom = new \DOMDocument();
        @$dom->loadHTML($html); // Suppress warnings due to malformed HTML

        // Use DOMXPath to navigate and extract data
        $xpath = new \DOMXPath($dom);
        $rows = $xpath->query('//table[contains(@class, "table")][1]/tbody/tr');

        // Initialize an array to store the scraped data
        $data = [];
        foreach ($rows as $row) {
            $columns = $row->getElementsByTagName('td');
            if ($columns->length >= 2) {
                $symbol = trim($columns->item(0)->textContent);
                $ltp = trim($columns->item(1)->textContent);
                
                // Add data to the array
                $data[] = [
                    'symbol' => $symbol,
                    'ltp' => $ltp
                ];
            }
        }

        // Pass the scraped data to the Blade view
        return view('scrapedData', ['data' => $data]);
    }
}

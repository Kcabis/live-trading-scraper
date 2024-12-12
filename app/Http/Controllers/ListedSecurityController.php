<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListedSecurity;

class ListedSecurityController extends Controller
{
    public function uploadCsv(Request $request)
    {
        $request->validate([
            'csvFileInput' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('csvFileInput');
        $data = array_map('str_getcsv', file($file->getRealPath()));

        // Skip the header row
        $header = array_shift($data);

        foreach ($data as $row) {
            ListedSecurity::create([
                'stock_id' => $row[0],
                'Date' => $row[1],
                'S_ID' => $row[2],
                'symbol' => $row[3],
                'Name'=>$row[4],
            ]);
        }

        return response()->json(['message' => 'Data successfully saved to the database.']);
    }

    public function index()
    {
        $securities = ListedSecurity::all();
        return view('admin', compact('securities'));
    }
}

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
    // Delete a single security
    public function destroy($id)
    {
        $security = ListedSecurity::findOrFail($id);
        $security->delete();

        return redirect()->back()->with('success', 'Security deleted successfully.');
    }

    // Delete all securities
    public function destroyAll()
    {
        ListedSecurity::truncate(); // Deletes all records in the table
        return redirect()->back()->with('success', 'All securities deleted successfully.');
    }
}

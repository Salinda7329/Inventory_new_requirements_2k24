<?php

namespace App\Http\Controllers;

use App\Imports\GrnImport;
use App\Models\Grn;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GrnController extends Controller
{
    public function import_grn_data(Request $request)
    {

        // dd($request->all());
        // Validate the request
        $request->validate([
            'import_file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        // Import the data from the file
        try {
            Excel::import(new GrnImport, $request->file('import_file'));
            return redirect()->back()->with('status', 'GRN data imported successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred while importing GRN data: ' . $e->getMessage());
        }
    }
}

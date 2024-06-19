<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CsvService;

class CsvUploadController extends Controller
{
    protected $csvService;

    public function __construct(CsvService $csvService)
    {
        $this->csvService = $csvService;
    }

    public function upload(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'csvFile' => 'required|mimes:csv,txt|max:2048', // Example validation rules,
            'type' => 'required'
        ]);

        // Process the uploaded CSV file
        $csvData = $this->csvService->import($request->file('csvFile'), $request->type);

        // Optionally, validate and process $csvData further if needed

        // Return response
        return redirect()->back();
    }
}

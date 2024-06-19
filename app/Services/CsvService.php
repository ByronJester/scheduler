<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class CsvService
{
    public function import($file, $type)
    {
        // Get file path
        $filePath = $file->getRealPath();

        // Initialize CSV reader with custom delimiter (semicolon)
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setDelimiter(';'); // Set delimiter here

        // Fetch CSV headers and rows
        $csv->setHeaderOffset(0); // Assuming the first row is header
        $records = $csv->getRecords();

        $importedRows = [];

        $table = ($type == 'room') ? 'room_schedules' : 'teacher_schedules';

        foreach ($records as $record) {
            // Process each row (record) here
            // Assuming 'Teacher ID', 'Room Name', 'Start Time', 'End Time', 'Class' are headers in CSV

            $importedRow = [];

            if($type == 'room') {
                $importedRow = [
                    'user_id' => $record['Teacher ID'],
                    'name' => $record['Room Name'],
                    'start_time' => $record['Start Time'],
                    'end_time' => $record['End Time'],
                    'class' => $record['Class'],
                ];
            } else {
                $importedRow = [
                    'user_id' => $record['Teacher ID'],
                    'day' => $record['Day'],
                    'start_time' => $record['Start Time'],
                    'end_time' => $record['End Time'],
                    'class' => $record['Class'],
                ];
            }

            // Save each row to database (example)
            DB::table($table)->insert($importedRow);

            // Collect imported rows if needed for response or logging
            $importedRows[] = $importedRow;
        }

        // Return imported rows or any other response
        return $importedRows;
    }
}

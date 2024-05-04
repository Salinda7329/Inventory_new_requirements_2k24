<?php

namespace App\Imports;

use App\Models\Grn; // Assuming Grn is the model representing your data
use App\Models\Input;
use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Validators\ValidationException;

class GrnImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        try {
            // Your import logic here

            // For example:
            $Grn = new Grn([
                // Grn attributes assignment
            ]);
            $Grn->save();

            // Input creation and item balance update logic

        } catch (ValidationException $e) {
            // Handle validation errors
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $row = $failure->row(); // Row that failed validation
                $errors = $failure->errors(); // Validation errors
                // Handle or log validation errors
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            \Log::error('Error occurred during GRN import: ' . $e->getMessage());
            // You can throw the exception again if you want to bubble it up
            throw $e;
        }
    }
}


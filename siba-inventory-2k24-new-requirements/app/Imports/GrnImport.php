<?php

namespace App\Imports;

use App\Models\Grn; // Assuming Grn is the model representing your data
use App\Models\Input;
use App\Models\Item;
use App\Models\ItemsNew;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Validators\ValidationException;


class GrnImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        try {

            $requested_by = $rows[6][2];
            $company = $rows[6][5];
            $good_receiving_note_number = $rows[7][2];
            $item_to_be_used_location = $rows[7][5];
            $handed_over_by = $rows[8][2];
            $handed_over_date = $rows[8][5];
            $received_by = $rows[9][2];
            $received_date = $rows[9][5];

            // Create Grn instance and save using User-No mode
            $Grn = new Grn([
                'requested_by' => $requested_by,
                'company' => $company,
                'good_receiving_note_number' => $good_receiving_note_number,
                'item_to_be_used_location' => $item_to_be_used_location,
                'handed_over_by' => $handed_over_by,
                'handed_over_date' => $handed_over_date,
                'received_by' => $received_by,
                'received_date' => $received_date,
            ]);

            // Save the grn instance
            $Grn->save();

            // Access data from cells A6, A7, A8 for both "Name" and "Town"
            $item_refs = [$rows[12][3], $rows[13][3]]; // Name cells
            $quantities = [$rows[12][2], $rows[13][2]]; // Town cells

            // Access data from cells A6, A7, A8 for both "Name" and "Town"
            $item_refs = [];
            $quantities = [];

            // Start from row index 12 for "Name" and "Town"
            $start_row_index = 12;
            // Column index for "Name" (A)
            $name_column_index = 3;
            // Column index for "Town" (B)
            $town_column_index = 2;

            // define item ids array
            $item_ids = [];

            // Iterate over the rows starting from the specified index
            for ($row_index = $start_row_index; $row_index < $rows->count(); $row_index++) {
                // Get the name and town from the respective columns
                $item_ref = $rows[$row_index][$name_column_index];
                $quantity = $rows[$row_index][$town_column_index];

                // Add the name and town to their respective arrays if they are not null
                if ($item_ref !== null && $quantity !== null) {
                    // Find the ItemsNew model with the given item_ref
                    $item = ItemsNew::where('item_ref', $item_ref)->first();

                    // If item exists, get its ID and add it to the array
                    if ($item) {
                        $item_ids[] = $item->id;
                        $quantities[] = $quantity;
                    }
                }
            }

            // Print the arrays
            // dd($item_ids, $quantities);

            $inputArray = []; // Define an empty array to store newInput objects
            // Create Input instances for each name and town
            foreach ($item_ids as $key => $item_id) {
                $quantity = $quantities[$key];

                // Create Input instance and save
                $newInput = new Input([
                    'grn_no' => $good_receiving_note_number,
                    // 'po_id' => $good_receiving_note_number,
                    'item_id' => $item_id,
                    'count' => $quantity,
                    'created_by' => 1,
                    // 'po_id' => 21,
                    // 'item_id' => 49,
                    // 'count' => 150,
                    // 'created_by' => 1,
                ]);

                $inputArray[] = $newInput; // Add newInput to the array
                // Print the array after the loop
                // dd($inputArray);

                $newInput->save();


                // Update item balance
                $item = ItemsNew::find($item_id);


                if ($item) {
                    $item->items_remaining += $quantity;
                    // Print the array after the loop
                    $item->save();
                    $itemArray[] = $item; // Add newInput to the array
                }
                // dd($inputArray);
            }
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

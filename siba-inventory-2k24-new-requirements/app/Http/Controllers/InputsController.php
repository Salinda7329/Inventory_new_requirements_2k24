<?php

namespace App\Http\Controllers;

use App\Models\Input;
use App\Models\ItemsNew;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InputsController extends Controller
{
    // public function create(Request $request)
    // {
    //     try {
    //         $input = $request->validate([
    //             'user_id_hidden' => ['required', 'numeric'], // Assuming user ID is numeric
    //             'po_no2' => ['required', 'numeric'], // Assuming PO number is numeric
    //             'item_id2' => ['required', 'numeric'], // Assuming item ID is numeric
    //             'item_count2' => ['required', 'numeric', 'min:1'], // Minimum count is 1
    //         ]);

    //         Input::create([
    //             'po_id' => $input['po_no2'],
    //             'item_id' => $input['item_id2'],
    //             'count' => $input['item_count2'],
    //             'created_by' => $input['user_id_hidden'],
    //         ]);

    //         // Return the success response after the item is created
    //         return response()->json(['message' => 'New item created successfully.', 'status' => 200]);
    //     } catch (ValidationException $e) {
    //         // Handle validation errors
    //         return response()->json(['errors' => $e->errors(), 'status' => 422]);
    //         // } catch (QueryException $e) {
    //         //     // Log the error
    //         //     \Log::error($e);
    //         //     return response()->json(['error' => 'Failed to create item.', 'status' => 500]);
    //         // }
    //     }
    // }

    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'user_id_hidden' => ['required', 'numeric'],
                'po_no2' => ['required', 'numeric'],
                'item_id2' => ['required', 'numeric'],
                'item_count2' => ['required', 'numeric', 'min:1'],
            ]);

            // Create a new input record
            $newInput = Input::create([
                'po_id' => $input['po_no2'],
                'item_id' => $input['item_id2'],
                'count' => $input['item_count2'],
                'created_by' => $input['user_id_hidden'],
            ]);

            // Update the items_remaining column in the items_new table
            $item = ItemsNew::find($input['item_id2']);
            $item->items_remaining += $input['item_count2'];
            $item->save();

            // Return success response after the item is created and count is updated
            return response()->json(['message' => 'New item created successfully.', 'status' => 200]);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error
            \Log::error($e);
            return response()->json(['error' => 'Failed to create item.', 'status' => 500]);
        }
    }

    public function fetchAllNewStockData()
    {

        $items = Input::all();

        //returning data inside the table
        $response = '';

        if ($items->count() > 0) {

            $response .=
                "<table id='all_new_stock_data' class='display'>
                <thead>
                <tr>
                <th>Transaction No</th>
                        <th>PO No</th>
                        <th>Item Reference</th>
                        <th>Item</th>
                        <th>Input Count</th>
                        <th>Input By</th>
                        <th>Input TimeStamp</th>
                        <th>Updated TimeStamp</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($items as $item) {
                $response .= "<tr>
                        <td>" . $item->id . "</td>
                        <td>" . $item->getPoData->po_no . "</td>
                                        <td>" . $item->getmainItemRef->item_ref . "</td>
                                        <td>" . $item->getmainItemData->item_name . "</td>
                                        <td>" . $item->count . "</td>
                                        <td>" . $item->createdByUser->name . "</td>
                                        <td>" . $item->created_at . "</td>
                                        <td>" . $item->updated_at . "</td>
                                        <td>" . $item->getIsActiveInputttribute() . "</td>
                                        <td><a href='#' id='" . $item->id . "'  data-bs-toggle='modal'
                                        data-bs-target='#modaleditInput' class='editInputButton'>Edit</a>
                                        </td>
                                        </tr>";
            }



            $response .=
                "</tbody>
                </table>";

            echo $response;
        } else {
            echo "<h3 align='center'>No Records in Database</h3>";
        }
    }

    // public function edit(Request $request)
    // {
    //     $input_Id = $request->input_Id;
    //     $input = Input::find($input_Id);
    //     return response()->json($input);
    // }

    public function edit(Request $request)
    {
        $input_Id = $request->input_Id;
        $input = Input::find($input_Id);

        if ($input) {
            // Assuming getPoData() is the relationship method defined in Input model
            $po_id = $input->getPoData->po_id;

            // Include both input data and po_no in the response
            return response()->json([
                'input' => $input,
                'po_id' => $po_id
            ]);
        } else {
            // Handle case when input is not found
            return response()->json(['error' => 'Input not found'], 404);
        }
    }

    public function update(Request $request)
    {
        try {
            // Validate the input
            $input = $request->validate([
                'user_id_hidden2' => ['required', 'numeric'],
                'input_id_hidden' => ['required', 'numeric'],
                'count_hidden' => ['required'],
                'po_no10' => ['required', 'numeric'],
                'item_id2' => ['required', 'numeric'],
                'item_count2' => ['required', 'numeric', 'min:1'],
            ]);

            // Find the input record by its ID
            $inputRecord = Input::findOrFail($input['input_id_hidden']);

            // Check if any value is edited
            if (
                $inputRecord->po_id != $input['po_no10'] ||
                $inputRecord->item_id != $input['item_id2'] ||
                $inputRecord->count != $input['item_count2']
            ) {

                // Update the input record with new values
                $inputRecord->update([
                    'po_id' => $input['po_no10'],
                    'item_id' => $input['item_id2'],
                    'count' => $input['item_count2'],
                ]);


                // Update the items_remaining column in the items_new table
                $item = ItemsNew::find($input['item_id2']);
                $item->items_remaining += ($input['item_count2']- $input['count_hidden']);
                $item->save();

                // Return success response after updating the input record
                return response()->json(['message' => 'Input record updated successfully.', 'status' => 200]);
            } else {
                // If no values are edited, return a response indicating no changes
                return response()->json(['message' => 'No changes were made.', 'status' => 204]);
            }
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (\Exception $e) {
            // Log the error
            \Log::error($e);
            return response()->json(['error' => 'Failed to update input record.', 'status' => 500]);
        }
    }
}

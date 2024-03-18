<?php

namespace App\Http\Controllers;

use App\Models\Input;
use App\Models\ItemsNew;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class InputsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'user_id_hidden' => ['required', 'numeric'], // Assuming user ID is numeric
                'po_no2' => ['required', 'numeric'], // Assuming PO number is numeric
                'item_id2' => ['required', 'numeric'], // Assuming item ID is numeric
                'item_count2' => ['required', 'numeric', 'min:1'], // Minimum count is 1
            ]);

            Input::create([
                'po_id' => $input['po_no2'],
                'item_id' => $input['item_id2'],
                'count' => $input['item_count2'],
                'created_by' => $input['user_id_hidden'],
            ]);

            // Return the success response after the item is created
            return response()->json(['message' => 'New item created successfully.', 'status' => 200]);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
            // } catch (QueryException $e) {
            //     // Log the error
            //     \Log::error($e);
            //     return response()->json(['error' => 'Failed to create item.', 'status' => 500]);
            // }
        }
    }
}

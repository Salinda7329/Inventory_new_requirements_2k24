<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InputsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'user_id_hidden' => ['required'],
                'po_no2' => ['required'],
                'item_id2' => ['required'],
                'item_count2' => ['required', 'string', 'max:255', 'min:0'],

            ]);
            return DB::transaction(function () use ($input) {
                // Use Carbon to get the current timestamp
                $currentTimestamp = now();
                Item::create([
                    'created_by' => $input['user_id_hidden'],
                    'owner' => $input['owner_hidden'],
                    'flag_request' => 2,
                    'flag_return' => 2,
                    'po_no' => $input['po_no'],
                    'product_id' => $input['product_id'],
                    'brand_id' => $input['brand_id'],
                    'item_name' => $input['item_name'],
                    'condition' => $input['condition'],
                    'condition_updated_by' => $input['user_id_hidden'],
                    'condition_updated_timestamp' =>  $currentTimestamp,
                    'items_remaining' => $input['items_remaining'],
                    'lower_limit' => $input['lower_limit'],

                ]);

                // Return the success response after the user is created
                return response()->json(['message' => 'New item created successfully.', 'status' => 200]);
            });
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);

            return response()->json(['error' => 'Failed to create product.', 'status' => 500]);
        }
    }
}

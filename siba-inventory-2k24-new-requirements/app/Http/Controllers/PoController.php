<?php

namespace App\Http\Controllers;

use App\Models\Porder;
use Doctrine\DBAL\Query\QueryException;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class PoController extends Controller
{
    public function create(Request $request)
    {
        $file = $request->file('po_image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/po_images', $fileName);

        try {
            $input = $request->validate([
                'po_no' => ['required', 'string', 'max:255', 'unique:porders'],
                'po_image' => ['required'],
                'user_id_hidden' => ['required'],
            ]);
            // Create the new item using the Item model

            Porder::create([
                'po_no' => $input['po_no'],
                'image' =>$fileName,
                'created_by' => $input['user_id_hidden'],
            ]);

            // Return the success response after the user is created
            return response()->json(['message' => 'New item created successfully.', 'status' => 200]);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);

            return response()->json(['error' => 'Failed to create product.', 'status' => 500]);
        }
    }
}

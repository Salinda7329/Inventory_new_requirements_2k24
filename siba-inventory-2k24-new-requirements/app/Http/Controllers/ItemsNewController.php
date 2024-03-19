<?php

namespace App\Http\Controllers;

use App\Models\ItemsNew;
use Doctrine\DBAL\Query\QueryException;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemsNewController extends Controller
{
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'item_name' => ['required', 'string', 'max:255', 'unique:items_news'],
                'category_id' => ['required'],
                'user_id_hidden' => ['required'],
                'lower_limit' => ['max:255', 'min:0'],
            ]);
            // Create the new item using the Item model
            ItemsNew::create([
                'item_name' => $input['item_name'],
                'category_id' => $input['category_id'],
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

    public function fetchAllItemDataNew()
    {

        $items = ItemsNew::all();

        //returning data inside the table
        $response = '';

        if ($items->count() > 0) {

            $response .=
                "<table id='all_item_data' class='display'>
                    <thead>
                        <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Items remaining</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($items as $item) {
                $response .= "<tr>
                                        <td>" . $item->id . "</td>
                                        <td>" . $item->item_name . "</td>
                                        <td>" . $item->categoryData->category_name . "</td>
                                        <td>" . $item->items_remaining . "</td>
                                        <td>" . $item->createdByUser->name . "</td>
                                        <td>" . $item->created_at . "</td>
                                        <td>" . $item->updated_at . "</td>
                                        <td>" . $item->getIsActiveItemAttribute() . "</td>
                                        <td><a href='#' id='" . $item->id . "'  data-bs-toggle='modal'
                                        data-bs-target='#modaledititem' class='editItemButton'>Edit</a>
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

    public function edit(Request $request)
    {
        $item_Id = $request->item_Id;
        //find data of id using brand model
        $item = ItemsNew::find($item_Id);
        return response()->json($item);
    }

    public function update(Request $request)
    {

        try {
            $input = $request->validate([
                'item_name' => ['required', 'string', 'max:255'],
                'category_id' => ['required'],
                'user_id_hidden2' => ['required'],
            ]);
            $ItemsNew = ItemsNew::find($request->item_Id_hidden);
            // Create the new item using the Item model
            $ItemsNew->update([
                'item_name' => $input['item_name'],
                'category_id' => $input['category_id'],
                'created_by' => $input['user_id_hidden2'],
            ]);

            // Return the success response after the user is created
            return response()->json(['message' => 'Item Updated successfully.', 'status' => 200]);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);

            return response()->json(['error' => 'Failed to Update Item.', 'status' => 500]);
        }
    }

    public function fetchItemName()
    {
        $items = ItemsNew::select('id', 'item_name')->get(); // Select id and item_name from ItemsNew

        return response()->json($items);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ItemsNew;
use Doctrine\DBAL\Query\QueryException;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ItemsNewController extends Controller
{
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'item_name' => ['required', 'string', 'max:255', 'unique:items_news'],
                'item_ref' => ['required', 'string', 'max:255', 'unique:items_news'],
                'category_id' => ['required'],
                'user_id_hidden' => ['required'],
                'item_price' => ['numeric', 'min:0'],
                'lower_limit' => ['required', 'numeric', 'min:0'],
            ]);
            // Create the new item using the Item model
            ItemsNew::create([
                'item_name' => $input['item_name'],
                'item_ref' => $input['item_ref'],
                'category_id' => $input['category_id'],
                'lower_limit' => $input['lower_limit'],
                'item_price' => $input['item_price'],
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
                        <th>Reference</th>
                        <th>Category</th>
                        <th>Item Name</th>
                        <th>Balance</th>
                        <th>Item_Price</th>
                        <th>Value</th>
                        <th>Limit</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($items as $item) {
                $value = $item->item_price * $item->items_remaining;
                $limitStyle = ($item->items_remaining <= $item->lower_limit) ? 'color: red;' : '';
                $response .= "<tr>
                                            <td style='{$limitStyle}'>" . $item->item_ref . "</td>
                                            <td>" . $item->categoryData->category_name . "</td>
                                            <td style='{$limitStyle}'>" . $item->item_name . "</td>
                                            <td style='{$limitStyle}'>" . $item->items_remaining . "</td>
                                            <td>" . $item->item_price . "</td>
                                            <td>" . $value . "</td>
                                            <td style='{$limitStyle}'>" . $item->lower_limit . "</td>
                                            <td>" . $item->createdByUser->name . "</td>
                                            <td>" . $item->created_at . "</td>
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

    public function fetchAllLowItemDataNew()
    {
        // Fetch items with is active 1
        $items = ItemsNew::All()->where('isActive', 1);


        // Return response
        $response = '';

        if ($items->count() > 0) {
            $response .=
                "<table id='all_low_item_data' class='display'>
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Category</th>
                        <th>Item Name</th>
                        <th>Balance</th>
                        <th>Item_Price</th>
                        <th>Value</th>
                        <th>Limit</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";

            foreach ($items as $item) {
                $currentItemCount = $item->items_remaining;
                $lowerLimit = $item->lower_limit;

                if ($currentItemCount <= $lowerLimit) {


                    $value = $item->item_price * $item->items_remaining;
                    $limitStyle = 'color: red;';
                    $response .= "<tr>
                                <td style='{$limitStyle}'>" . $item->item_ref . "</td>
                                <td>" . $item->categoryData->category_name . "</td>
                                <td style='{$limitStyle}'>" . $item->item_name . "</td>
                                <td style='{$limitStyle}'>" . $item->items_remaining . "</td>
                                <td>" . $item->item_price . "</td>
                                <td>" . $value . "</td>
                                <td style='{$limitStyle}'>" . $item->lower_limit . "</td>
                                <td>" . $item->createdByUser->name . "</td>
                                <td>" . $item->created_at . "</td>
                                <td>" . $item->getIsActiveItemAttribute() . "</td>
                                <td><a href='#' id='" . $item->id . "'  data-bs-toggle='modal'
                                    data-bs-target='#modaledititem' class='editItemButton'>Edit</a>
                                </td>
                            </tr>";
                }
            }

            $response .= "</tbody>
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
                'item_ref' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('items_news')->ignore($request->item_Id_hidden)->when($request->item_ref !== $request->old_item_ref, function ($query) use ($request) {
                        return $query->where('item_ref', $request->item_ref);
                    }),
                ],
                'item_name' => ['required', 'string', 'max:255'],
                'category_id' => ['required'],
                'user_id_hidden2' => ['required'],
                'item_price' => ['numeric', 'min:0'],
                'lower_limit' => ['required', 'numeric', 'min:0'],
                'isActive' => ['required'],
            ]);
            $ItemsNew = ItemsNew::find($request->item_Id_hidden);
            // Create the new item using the Item model
            $ItemsNew->update([
                'item_ref' => $input['item_ref'],
                'item_name' => $input['item_name'],
                'category_id' => $input['category_id'],
                'item_price' => $input['item_price'],
                'lower_limit' => $input['lower_limit'],
                'created_by' => $input['user_id_hidden2'],
                'isActive' => $input['isActive'],
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

    public function fetchItemNameAuto(Request $request)
    {
        $term = $request->input('term');

        // Query the database to fetch item names and ids that match the user input
        $items = ItemsNew::where('item_name', 'like', '%' . $term . '%')->get(['id', 'item_name']);

        return response()->json($items);
    }
}

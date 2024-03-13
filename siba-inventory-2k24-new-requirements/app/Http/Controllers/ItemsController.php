<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Validation\ValidationException;

class ItemsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'user_id_hidden' => ['required'],
                'owner_hidden' => ['required'],
                'po_no' => ['required'],
                'product_id' => ['required'],
                'brand_id' => ['required'],
                'item_name' => ['required', 'string', 'max:255', 'unique:items'],
                'condition' => ['required'],
                'items_remaining' => ['required', 'string', 'max:255', 'min:0'],
                'lower_limit' => ['required', 'string', 'max:255', 'min:0'],

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

    //Not for users
    // public function fetchAllItemData()
    // {

    //     $items = Item::all();

    //     //returning data inside the table
    //     $response = '';

    //     if ($items->count() > 0) {

    //         $response .=
    //             "<table id='all_item_data' class='display'>
    //                 <thead>
    //                     <tr>
    //                     <th>Item ID</th>
    //                     <th>Category</th>
    //                     <th>Product Name</th>
    //                     <th>Brand Name</th>
    //                     <th>PO No</th>
    //                     <th>Item Name</th>
    //                     <th>Availability</th>
    //                     <th>Owner</th>
    //                     <th>Condition</th>
    //                     <th>Condition Updated By</th>
    //                     <th>Condition Updated TimeStamp</th>
    //                     <th>Items remaining</th>
    //                     <th>Lower limit</th>
    //                     <th>Input TimeStamp</th>
    //                     <th>Created By</th>
    //                     <th>Updated TimeStamp</th>
    //                     <th>Status</th>
    //                     <th>Action</th>
    //                     </tr>
    //                 </thead>
    //                 <tbody>";

    //         foreach ($items as $item) {
    //             $response .= "<tr>
    //                                     <td>" . $item->id . "</td>
    //                                     <td>" . $item->productData->categoryData->category_name . "</td>
    //                                     <td>" . $item->productData->product_name . "</td>
    //                                     <td>" . $item->brandData->brand_name . "</td>
    //                                     <td>" . $item->po_no . "</td>
    //                                     <td>" . $item->item_name . "</td>
    //                                     <td>" . $item->getIsAvailabilityAttribute() . "</td>
    //                                     <td>" . ($item->ownerUser && $item->ownerUser->name ? $item->ownerUser->name : 'N/A') . "</td>
    //                                     <td>" . $item->getIsCondtionItemAttribute() . "</td>
    //                                     <td>" . $item->conditionUpdatedByUser->name . "</td>
    //                                     <td>" . $item->condition_updated_timestamp . "</td>
    //                                     <td>" . $item->items_remaining . "</td>
    //                                     <td>" . $item->lower_limit . "</td>
    //                                     <td>" . $item->created_at . "</td>
    //                                     <td>" . $item->createdByUser->name . "</td>
    //                                     <td>" . $item->updated_at . "</td>
    //                                     <td>" . $item->getIsActiveItemAttribute() . "</td>
    //                                     <td><a href='#' id='" . $item->id . "'  data-bs-toggle='modal'
    //                                     data-bs-target='#modaledititem' class='editItemButton'>Edit</a>
    //                                     </td>
    //                                 </tr>";
    //         }



    //         $response .=
    //             "</tbody>
    //             </table>";

    //         echo $response;
    //     } else {
    //         echo "<h3 align='center'>No Records in Database</h3>";
    //     }
    // }
    public function fetchAllItemData()
    {

        $items = Item::all();

        //returning data inside the table
        $response = '';

        if ($items->count() > 0) {

            $response .=
                "<table id='all_item_data' class='display'>
                    <thead>
                        <tr>
                        <th>Item ID</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Brand Name</th>
                        <th>PO No</th>
                        <th>Item Name</th>
                        <th>Availability</th>
                        <th>Owner</th>
                        <th>Condition</th>
                        <th>Condition Updated By</th>
                        <th>Condition Updated TimeStamp</th>
                        <th>Items remaining</th>
                        <th>Lower limit</th>
                        <th>Input TimeStamp</th>
                        <th>Created By</th>
                        <th>Updated TimeStamp</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($items as $item) {
                $response .= "<tr>
                                        <td>" . $item->id . "</td>
                                        <td>" . $item->productData->categoryData->category_name . "</td>
                                        <td>" . $item->productData->product_name . "</td>
                                        <td>" . $item->brandData->brand_name . "</td>
                                        <td>" . $item->po_no . "</td>
                                        <td>" . $item->item_name . "</td>
                                        <td>" . $item->getIsAvailabilityAttribute() . "</td>
                                        <td>" . ($item->ownerUser && $item->ownerUser->name ? $item->ownerUser->name : 'N/A') . "</td>
                                        <td>" . $item->getIsCondtionItemAttribute() . "</td>
                                        <td>" . $item->conditionUpdatedByUser->name . "</td>
                                        <td>" . $item->condition_updated_timestamp . "</td>
                                        <td>" . $item->items_remaining . "</td>
                                        <td>" . $item->lower_limit . "</td>
                                        <td>" . $item->created_at . "</td>
                                        <td>" . $item->createdByUser->name . "</td>
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

    //for users only
    public function fetchAllItemDataUser()
    {

        // $items = Item::all();
        // Retrieve only active items
        $items = Item::where('isActive', 1)->where('condition', 1)->where('availability', 1)->get();


        //returning data inside the table
        $response = '';

        if ($items->count() > 0) {

            $response .=
                "<table id='all_item_data' class='display'>
                    <thead>
                        <tr>
                        <th>Item ID</th>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Brand Name</th>
                        <th>Item Name</th>
                        <th>Input TimeStamp</th>
                        <th>Updated TimeStamp</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($items as $item) {
                $response .= "<tr>
                                        <td>" . $item->id . "</td>
                                        <td>" . $item->productData->categoryData->category_name . "</td>
                                        <td>" . $item->productData->product_name . "</td>
                                        <td>" . $item->brandData->brand_name . "</td>
                                        <td>" . $item->item_name . "</td>
                                        <td>" . $item->created_at . "</td>
                                        <td>" . $item->updated_at . "</td>
                                        <td><a href='#' id='" . $item->id . "'  class='requestItemButton btn-sm btn btn-primary' >Request Item</a>
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
        $item = Item::find($item_Id);
        return response()->json($item);
    }

    public function update(Request $request)
    {
        $item = Item::find($request->item_Id_hidden);

        $item->update([
            'po_no' => $request->po_no,
            'product_id' => $request->product_id,
            'brand_id' => $request->brand_id,
            'item_name' => $request->item_name,
            'condition' => $request->condition,
            'condition_updated_by' => $request->user_id_hidden2,
            'items_remaining' => $request->items_remaining,
            'lower_limit' => $request->lower_limit,
            'isActive' => $request->isActive,
        ]);

        return response()->json([
            'status' => 200,
        ]);
    }

}

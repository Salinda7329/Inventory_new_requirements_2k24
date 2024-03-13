<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Item;
use Illuminate\Validation\Rule;
use Symfony\Contracts\Service\Attribute\Required;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'category_id' => ['required'],
                'product_name' => ['required', 'string', 'max:255', 'unique:products'],
                'user_id_hidden' => ['required'],
                'lower_limit' => ['required', 'integer', 'max:255', 'min:0'],
            ]);
            return DB::transaction(function () use ($input) {
                Product::create([
                    'category_id' => $input['category_id'],
                    'product_name' => $input['product_name'],
                    'created_by' => $input['user_id_hidden'],
                    'lower_limit' => $input['lower_limit'],
                ]);

                // Return the success response after the user is created
                return response()->json(['message' => 'New product created successfully.', 'status' => 200]);
            });
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);

            return response()->json(['error' => 'Failed to create product.', 'status' => 500]);
        }
    }

    public function fetchAllProductData()
    {

        $products = Product::all();

        //returning data inside the table
        $response = '';

        if ($products->count() > 0) {

            $response .=
                "<table id='all_product_data' class='display'>
                    <thead>
                        <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Lower Limit</th>
                        <th>Input Date</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Updated At</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($products as $product) {

                // Determine status color and text
                $statusColor = '';
                $statusText = '';

                switch ($product->isActive) {
                    case 1:
                        $statusColor = 'green';
                        $statusText = 'Active';
                        break;
                    case 2:
                        $statusColor = 'red';
                        $statusText = 'Deactivated';
                        break;
                    case 3:
                        $statusColor = 'gray';
                        $statusText = 'Deleted';
                        break;
                    default:
                        $statusColor = 'black';
                        $statusText = 'Unknown';
                }

                $response .=
                    "<tr>
                            <td>" . $product->id . "</td>
                            <td>" . $product->product_name . "</td>
                            <td>" . $product->categoryData->category_name . "</td>
                            <td>" . $product->lower_limit . "</td>
                            <td>" . $product->created_at . "</td>
                            <td>" . $product->createdByUser->name . "</td>
                            <td style='color: $statusColor'>$statusText</td>
                            <td>" . $product->updated_at . "</td>
                            <td><a href='#' id='" . $product->id . "'  data-bs-toggle='modal'
                            data-bs-target='#modaleditproduct' class='editProductButton'>Edit</a>
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
        $product_Id = $request->product_Id;
        //find data of id using Student model
        $product = Product::find($product_Id);
        return response()->json($product);
    }

    // public function update(Request $request)
    // {
    //     $product = Product::find($request->product_Id_hidden);

    //     $product->update([
    //         'product_name' => $request->product_name,
    //         'category_id' => $request->category_id,
    //         'lower_limit' => $request-> lower_limit,
    //         'isActive' => $request->isActive,
    //     ]);

    //     return response()->json([
    //         'status' => 200,
    //     ]);
    // }

    public function update(Request $request)
    {
        try {
            $product = Product::find($request->product_Id_hidden);

            $input = $request->validate([
                'product_name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($product->id)],
                'category_id' => ['required', 'integer', 'max:255', 'min:1'],
                'lower_limit' => ['required', 'integer', 'max:255', 'min:0'],
                'isActive' => ['required', 'integer', 'max:255', 'min:1'],
            ]);

            return DB::transaction(function () use ($product, $input) {
                $product->update([
                    'product_name' => $input['product_name'],
                    'category_id' => $input['category_id'],
                    'lower_limit' => $input['lower_limit'],
                    'isActive' => $input['isActive'],
                    // Add other fields here if needed
                ]);

                return response()->json([
                    'status' => 200,
                ]);
            });
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);
            return response()->json(['error' => 'Failed to update product.', 'status' => 500]);
        }
    }



    public function fetchProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function fetchProductDetails(Request $request)
    {
        $productId = $request->input('productId');

        // Replace this with your logic to fetch product details based on $productId
        $product = Product::find($productId);

        return response()->json([
            'product_name' => $product->product_name,
            // Add other fields you want to fetch
        ]);
    }

    public function pmProductLimits()
    {
        $products = Product::with('categoryData')->where('isActive', 1)
            ->get(); // Assuming you have a relationship between products and categories
        $productData = [];
        foreach ($products as $product) {
            $currentItemCount = Item::where('product_id', $product->id)
                ->where('isActive', 1)
                ->count();
            $availableItemCount = Item::where('product_id', $product->id)
                ->where('isActive', 1)
                ->where('condition', 1)
                ->where('availability', 1)
                ->count();
            $damagedItemCount = Item::where('product_id', $product->id)
                ->where('isActive', 1)
                ->where('condition', 2) // Only include items with condition 1 (damaged items)
                ->count();

            $lowerLimit = $product->lower_limit;

            // Determine if the current item count minus the damaged item count equals the lower limit
            $balance = ($currentItemCount - $damagedItemCount);

            if ($balance > $lowerLimit) {
                $over = 0;
            }

            // $isAtLowerLimit = ($balance == $lowerLimit);

            $productData[] = [
                'product_id' => $product->id,
                'lower_limit' => $lowerLimit,
                'balance' => $balance,
                'availableItemCount' => $availableItemCount,
                'product_name' => $product->product_name,
                'category' => $product->categoryData->category_name,
                'current_item_count' => $currentItemCount,
                'damaged_item_count' => $damagedItemCount,
                'is_at_lower_limit' => $balance <= $lowerLimit, // Add a flag indicating if the row is at the lower limit
            ];
        }

        return view('PurchasingManager.PMComponents.Product-levels', compact('productData'));
    }
    public function smProductLimits()
    {
        $products = Product::with('categoryData')->where('isActive', 1)
            ->get(); // Assuming you have a relationship between products and categories
        $productData = [];
        foreach ($products as $product) {
            $currentItemCount = Item::where('product_id', $product->id)
                ->where('isActive', 1)
                ->count();
            $availableItemCount = Item::where('product_id', $product->id)
                ->where('isActive', 1)
                ->where('condition', 1)
                ->where('availability', 1)
                ->count();
            $damagedItemCount = Item::where('product_id', $product->id)
                ->where('isActive', 1)
                ->where('condition', 2) // Only include items with condition 1 (damaged items)
                ->count();

            $lowerLimit = $product->lower_limit;

            // Determine if the current item count minus the damaged item count equals the lower limit
            $balance = ($currentItemCount - $damagedItemCount);

            if ($balance > $lowerLimit) {
                $over = 0;
            }

            // $isAtLowerLimit = ($balance == $lowerLimit);

            $productData[] = [
                'product_id' => $product->id,
                'lower_limit' => $lowerLimit,
                'balance' => $balance,
                'availableItemCount' => $availableItemCount,
                'product_name' => $product->product_name,
                'category' => $product->categoryData->category_name,
                'current_item_count' => $currentItemCount,
                'damaged_item_count' => $damagedItemCount,
                'is_at_lower_limit' => $balance <= $lowerLimit, // Add a flag indicating if the row is at the lower limit
            ];
        }

        return view('storeManager.product-levels', compact('productData'));
    }

    public function fetchItemsUnderProduct($product_id)
    {
        // Fetch the product based on the provided product ID
        $product = Product::find($product_id);

        // Fetch all items under the specified product ID
        $items = Item::where('product_id', $product_id)->get();

        // Pass the fetched product and items to the view
        return view('PurchasingManager.PMComponents.view-items-under-product', compact('product', 'items'));
    }
    public function fetchItemsUnderProductSM($product_id)
    {
        // Fetch the product based on the provided product ID
        $product = Product::find($product_id);

        // Fetch all items under the specified product ID
        $items = Item::where('product_id', $product_id)->get();

        // Pass the fetched product and items to the view
        return view('storeManager.view-items-under-product', compact('product', 'items'));
    }

    public function fetchItemsAndUsers()
    {
        $items = Item::all()->where('availability', 0);

        return view('PurchasingManager.view-items-and-users', compact('items'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{

    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'category_name' => ['required', 'string', 'max:255', 'unique:categories'],
                'user_id_hidden' => ['required'],
            ]);
            return DB::transaction(function () use ($input) {
                Category::create([
                    'category_name' => $input['category_name'],
                    'created_by' => $input['user_id_hidden'],
                ]);

                // Return the success response after the user is created
                return response()->json(['message' => 'New category created successfully.', 'status' => 200]);
            });
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);

            return response()->json(['error' => 'Failed to create category.', 'status' => 500]);
        }
    }

    public function fetchAllCategoryData()
    {

        $categories = Category::all();

        //returning data inside the table
        $response = '';

        if ($categories->count() > 0) {

            $response .=
                "<table id='all_category_data' class='display'>
                    <thead>
                        <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($categories as $category) {
                $response .=
                    "<tr>
                            <td>" . $category->id . "</td>
                            <td>" . $category->category_name . "</td>
                            <td>" . $category->createdByUser->name . "</td>
                            <td>" . $category->created_at . "</td>
                            <td>" . $category->getIsActiveCategoryAttribute() . "</td>
                            <td><a href='#' id='" . $category->id . "'  data-bs-toggle='modal'
                            data-bs-target='#modaleditcategory' class='editCategoryButton'>Edit</a>
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
        $category_Id = $request->category_Id;
        //find data of id using brand model
        $category = Category::find($category_Id);
        return response()->json($category);
    }

    public function update(Request $request)
    {
        $category = Category::find($request->category_Id_hidden2);

        $category->update([
            'category_name' => $request->category_name,
            'isActive' => $request->status2,
        ]);

        return response()->json([
            'status' => 200,
            'no' => $request->status2,
        ]);
    }

    public function fetchCategories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
}

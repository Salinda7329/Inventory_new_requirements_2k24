<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Brand;
use Symfony\Contracts\Service\Attribute\Required;

class BrandController extends Controller
{
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'brand_name' => ['required', 'string', 'max:255', 'unique:brands'],
                'user_id_hidden' => ['required'],
            ]);
            return DB::transaction(function () use ($input) {
                Brand::create([
                    'brand_name' => $input['brand_name'],
                    'created_by' => $input['user_id_hidden'],
                ]);

                // Return the success response after the user is created
                return response()->json(['message' => 'New brand created successfully.', 'status' => 200]);
            });
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);

            return response()->json(['error' => 'Failed to create brand.', 'status' => 500]);
        }
    }

    public function fetchAllBrandData()
    {

        $brands = Brand::all();

        //returning data inside the table
        $response = '';

        if ($brands->count() > 0) {

            $response .=
                "<table id='all_brand_data' class='display'>
                    <thead>
                        <tr>
                        <th>Brand ID</th>
                        <th>Brand Name</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($brands as $brand) {
                $response .=
                    "<tr>
                            <td>" . $brand->id . "</td>
                            <td>" . $brand->brand_name . "</td>
                            <td>" . $brand->createdByUser->name . "</td>
                            <td>" . $brand->created_at . "</td>
                            <td>" . $brand->getIsActiveBrandAttribute() . "</td>
                            <td><a href='#' id='" . $brand->id . "'  data-bs-toggle='modal'
                            data-bs-target='#modaleditbrand' class='editBrandButton'>Edit</a>
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
        $brand_Id = $request->brand_Id;
        //find data of id using brand model
        $brand = Brand::find($brand_Id);
        return response()->json($brand);
    }

    public function update(Request $request)
    {
        $brand = Brand::find($request->brand_Id_hidden);

        $brand->update([
            'brand_name' => $request->brand_name,
            'isActive' => $request->status1,
        ]);

        return response()->json([
            'status' => 200,
            'no' => $request->status1,
        ]);
    }

    public function fetchBrands()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Porder;
use Doctrine\DBAL\Query\QueryException;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PoController extends Controller
{
    public function create(Request $request)
    {
        $file = $request->file('po_image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/assets/po_images', $fileName);


        try {
            $input = $request->validate([
                'po_no' => ['required', 'string', 'max:255', 'unique:porders'],
                'po_image' => ['required'],
                'user_id_hidden' => ['required'],
            ]);
            // Create the new item using the Item model

            Porder::create([
                'po_no' => $input['po_no'],
                'image' => $fileName,
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

    public function fetchAllPoData()
    {

        $porders = Porder::all();

        //returning data inside the table
        $response = '';

        if ($porders->count() > 0) {

            $response .=
                "<table id='all_po_data' class='display'>
                    <thead>
                        <tr>
                        <th>PO_No</th>
                        <th>Image</th>
                        <th>Input Date</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Updated At</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($porders as $porder) {

                // Determine status color and text
                $statusColor = '';
                $statusText = '';

                switch ($porder->isActive) {
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
                        <td>" . $porder->po_no . "</td>
                        <td><a href='" . route('view.po.image', ['po_no' => $porder->po_no]) . "'><img src='" . asset('storage/assets/po_images/' . $porder->image) . "' width='50px' height='50px' class='img-thumbnail rounded-circle'></a></td>
                        <td>" . $porder->created_at . "</td>
                        <td>" . $porder->createdByUser->name . "</td>
                        <td style='color: $statusColor'>$statusText</td>
                        <td>" . $porder->updated_at . "</td>
                        <td><a href='#' id='" . $porder->id . "'  data-bs-toggle='modal' data-bs-target='#modaleditproduct' class='editProductButton'>Edit</a></td>
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

    public function viewPoImage($po_no)
    {
        // Retrieve the PO record by PO number
        $porder = Porder::where('po_no', $po_no)->firstOrFail();


        // Pass the $porder data and $pdfUrl to the view for displaying the PDF
        return view('PurchasingManager.PMComponents.view-po-image', compact('porder'));
    }
}

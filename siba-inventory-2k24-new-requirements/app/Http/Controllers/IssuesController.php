<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Issue;
use App\Models\ItemsNew;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class IssuesController extends Controller
{
    public function index()
    {
        return view('PurchasingManager.issue-items-page');
    }

    public function fetchAllItemMainData()
    {
        $itemsNew = ItemsNew::all();
        return response()->json($itemsNew);
    }

    public function fetchDepartmentData()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    // public function create(Request $request)
    // {
    //     try {
    //         $input = $request->validate([
    //             'user_id_hidden' => ['required'],
    //             'item_id' => ['required'],
    //             'count' => ['required', 'string', 'max:255', 'min:0'],
    //             'issued_to' => ['required'],
    //             'issue_remark' => ['required'],
    //         ]);

    //         // Create the Issue record
    //         $issue = Issue::create([
    //             'item_id' => $input['item_id'],
    //             'count' => $input['count'],
    //             'issued_to' => $input['issued_to'],
    //             'issue_remark' => $input['issue_remark'],
    //             'issued_by' => $input['user_id_hidden'],
    //         ]);

    //         // Update the items_remaining column in the items_new table
    //         $item = ItemsNew::find($input['item_id']);
    //         $item->items_remaining -= $input['count'];
    //         $item->save();

    //         // Return the success response after the issue is created
    //         return response()->json(['message' => 'Issued Successfully.', 'status' => 200]);
    //     } catch (ValidationException $e) {
    //         // Handle validation errors
    //         return response()->json(['errors' => $e->errors(), 'status' => 422]);
    //     } catch (QueryException $e) {
    //         // Log the error if needed: \Log::error($e);
    //         return response()->json(['error' => 'Failed to Issue.', 'status' => 500]);
    //     }
    // }
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'user_id_hidden' => ['required'],
                'item_id' => ['required'],
                'count' => ['required', 'string', 'max:255','numeric','min:1'],
                'issued_to' => ['required'],
                'issue_remark' => ['required'],
            ]);

            // Find the item
            $item = ItemsNew::find($input['item_id']);

            // Check if there are sufficient items remaining
            if ($item->items_remaining >= $input['count']) {
                // Create the Issue record
                $issue = Issue::create([
                    'item_id' => $input['item_id'],
                    'count' => $input['count'],
                    'issued_to' => $input['issued_to'],
                    'issue_remark' => $input['issue_remark'],
                    'issued_by' => $input['user_id_hidden'],
                ]);

                // Update the items_remaining column in the items_new table
                $item->items_remaining -= $input['count'];
                $item->save();

                // Return the success response after the issue is created
                return response()->json(['message' => 'Issued Successfully.', 'status' => 200]);
            } else {
                // Return a validation error if there are not enough items remaining
                return response()->json(['errors' => ['count' => ['No sufficient items']], 'status' => 422]);
            }
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);
            return response()->json(['error' => 'Failed to Issue.', 'status' => 500]);
        }
    }


    public function fetchAllIssueData()
    {

        $issues = Issue::all();

        //returning data inside the table
        $response = '';

        if ($issues->count() > 0) {

            $response .=
                "<table id='all_issue_data' class='display'>
                    <thead>
                        <tr>
                        <th>Issue No</th>
                        <th>Item Reference</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>To Department</th>
                        <th>Issue Remark</th>
                        <th>Issued by</th>
                        <th>Issued At</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($issues as $issue) {

                $response .=
                    "<tr>
                        <td>" . $issue->id . "</td>
                        <td>" . $issue->itemName->item_ref . "</td>
                        <td>" . $issue->itemName->item_name . "</td>
                        <td>" . $issue->count . "</td>
                        <td>" . $issue->toDepartment->dept_name . "</td>
                        <td>" . $issue->issue_remark . "</td>
                        <td>" . $issue->issueduserData->name . "</td>
                        <td>" . $issue->created_at . "</td>
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
}

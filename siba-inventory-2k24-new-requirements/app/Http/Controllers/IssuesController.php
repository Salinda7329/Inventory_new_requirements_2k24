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

    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'user_id_hidden' => ['required'],
                'item_id' => ['required'],
                'count' => ['required', 'string', 'max:255', 'min:0'],
                'issued_to' => ['required'],
                'issue_remark' => ['required'],
            ]);

            // Create the Issue record
            $issue = Issue::create([
                'item_id' => $input['item_id'],
                'count' => $input['count'],
                'issued_to' => $input['issued_to'],
                'issue_remark' => $input['issue_remark'],
                'issued_by' => $input['user_id_hidden'],
            ]);

            // Return the success response after the issue is created
            return response()->json(['message' => 'Issued Successfully.', 'status' => 200]);
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);
            return response()->json(['error' => 'Failed to Issue.', 'status' => 500]);
        }
    }
}

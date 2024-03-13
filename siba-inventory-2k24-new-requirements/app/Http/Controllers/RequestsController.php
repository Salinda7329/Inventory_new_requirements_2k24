<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Validation\ValidationException;

class RequestsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'request_by' => ['required'],
                'quantity_user' => ['required'],
                'user_remark' => ['required'],
                'item_user' => ['required'],
                'type' => ['required'],
                'status' => ['required'],
            ]);
            return DB::transaction(function () use ($input) {
                // Use Carbon to get the current timestamp
                $currentTimestamp = now();
                ModelsRequest::create([
                    'item_user' => $input['item_user'],
                    'quantity_user' => $input['quantity_user'],
                    'user_remark' => $input['user_remark'],
                    'request_by' => $input['request_by'],
                    'requested_timestamp' => $currentTimestamp,
                    'type' => $input['type'],
                    'status' => $input['status'],
                ]);

                // Return the success response after the user is created
                return response()->json(['message' => 'New request created successfully.', 'status' => 200]);
            });
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);

            return response()->json(['error' => 'Failed to create request.', 'status' => 500]);
        }
    }
    public function checkExistingRequest(Request $request)
    {
        try {
            $input = $request->validate([
                'request_by' => ['required'],
                'item_user' => ['required'],
            ]);

            // Check if a request with the same item_user and status=0 exists
            $existingRequest = ModelsRequest::where('item_user', $input['item_user'])
                ->where('request_by', $input['request_by'])
                ->where('status', 0)
                ->first();

            if ($existingRequest) {
                // Return error message if a request with the same item_user and status=0 exists
                return response()->json(['error' => 'You have already performed this action.', 'status' => 300]);
            } else {
                // Return success response if no existing request found
                return response()->json(['message' => 'No existing request found.', 'status' => 200]);
            }
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);

            return response()->json(['error' => 'Failed to create request.', 'status' => 500]);
        }
    }


    //for store manager. returns all request data of users
    public function fetchAllRequestData(Request $request)
    {
        // $store_manager = $request->sm_id;

        // // Retrieve only active items
        $requests = ModelsRequest::where('type', 1)->where('isActive', 1)->where('status', 0)->where('store_manager', null)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where(function ($query) use ($store_manager) {
        //         $query->where('store_manager', null)
        //             ->orWhere('store_manager', $store_manager);
        //     })
        //     ->get();

        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_request_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Remark</th>
                        <th>Requested_by</th>
                        <th>Requested_at</th>
                        <th>Department</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->requested_timestamp . "</td>
                                        <td>" . $department . "</td>
                                        <td id='requestButtonContainer'><a href='#' id='$request->id.$request->item_user' class='processRequestButton btn-sm btn btn-primary' >Process</a>
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

    //for store manager. returns all processing request data under each sm
    public function fetchAllProcessingRequestData(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        $requests = ModelsRequest::where('type', 1)->where('isActive', 1)->where('status', 1)->where('store_manager', $store_manager)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where(function ($query) use ($store_manager) {
        //         $query->where('store_manager', null)
        //             ->orWhere('store_manager', $store_manager);
        //     })
        //     ->get();

        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_request_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Remark</th>
                        <th>Requested_by</th>
                        <th>Requested_at</th>
                        <th>Department</th>
                        <th>Processed_at</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;


                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->created_at . "</td>
                                        <td>" . $department . "</td>
                                        <td>" . $request->updated_at . "</td>
                                        <td id='requestButtonContainer'><a href='#' id='" . $request->id . "'  data-bs-toggle='modal' data-bs-target='#actionModal' class='actionRequestButton  btn-sm btn btn-primary requestActionButton requestButtons'>Action</a>
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
    //for pruchasing manager. returns all processing request data under all sms
    public function fetchAllProcessingRequestDataPM(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        $requests = ModelsRequest::where('type', 1)->where('isActive', 1)->where('status', 1)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where(function ($query) use ($store_manager) {
        //         $query->where('store_manager', null)
        //             ->orWhere('store_manager', $store_manager);
        //     })
        //     ->get();

        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_request_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Remark</th>
                        <th>Requested_by</th>
                        <th>Requested_at</th>
                        <th>Department</th>
                        <th>SM_ID</th>
                        <th>SM</th>
                        <th>Processed_at</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;


                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->requested_timestamp . "</td>
                                        <td>" . $department . "</td>
                                        <td>" . $request->store_manager . "</td>
                                        <td>" . $request->storeManagerAttributes->name . "</td>
                                        <td>" . $request->updated_at . "</td>
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

    //to return rejected history
    public function fetchAllRejectedHistory(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->where('store_manager', $store_manager)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where('store_manager',$store_manager)->where(function ($query) use ($store_manager) {
        //         $query->where('status',2)
        //             ->orWhere('status',3);
        //     })
        //     ->get();

        $requests = ModelsRequest::where('isActive', 1)
            ->where('type', 1)
            ->where(function ($query) use ($store_manager) {
                $query->where('store_manager', $store_manager)
                    ->where(function ($query) {
                        $query->where('status', 3);
                    });
            })
            ->get();


        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_issued_items_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity" . "<br>" . "_User</th>
                        <th>Remark</th>
                        <th>Requested_by ID</th>
                        <th>Requested_by</th>
                        <th>Department</th>
                        <th>Requested_at</th>
                        <th>Sm Remark</th>
                        <th>Quantity</th>
                        <th>Rejected_at</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->request_by . "</td>
                                        <td>" . $department . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->created_at . "</td>
                                        <td>" . $request->sm_remark . "</td>
                                        <td>" . $request->quantity . "</td>
                                        <td>" . $request->updated_at . "</td>
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
    public function fetchAllRejectedReturnsHistory(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->where('store_manager', $store_manager)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where('store_manager',$store_manager)->where(function ($query) use ($store_manager) {
        //         $query->where('status',2)
        //             ->orWhere('status',3);
        //     })
        //     ->get();

        $requests = ModelsRequest::where('isActive', 1)
            ->where('type', 2)
            ->where(function ($query) use ($store_manager) {
                $query->where('store_manager', $store_manager)
                    ->where(function ($query) {
                        $query->where('status', 3);
                    });
            })
            ->get();


        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_issued_items_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity" . "<br>" . "_User</th>
                        <th>Remark</th>
                        <th>Requested_by ID</th>
                        <th>Requested_by</th>
                        <th>Department</th>
                        <th>Requested_at</th>
                        <th>Sm Remark</th>
                        <th>Quantity</th>
                        <th>Rejected_at</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->request_by . "</td>
                                        <td>" . $department . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->created_at . "</td>
                                        <td>" . $request->sm_remark . "</td>
                                        <td>" . $request->quantity . "</td>
                                        <td>" . $request->updated_at . "</td>
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
    public function fetchAllRejectsHistoryPM(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->where('store_manager', $store_manager)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where('store_manager',$store_manager)->where(function ($query) use ($store_manager) {
        //         $query->where('status',2)
        //             ->orWhere('status',3);
        //     })
        //     ->get();

        $requests = ModelsRequest::where('isActive', 1)
            ->where('type',1)
            ->where(function ($query) use ($store_manager) {
                $query->where(function ($query) {
                        $query->where('status', 3);
                    });
            })
            ->get();


        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='show_rejected_requests' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity" . "<br>" . "_User</th>
                        <th>Remark</th>
                        <th>Requested_by ID</th>
                        <th>Requested_by</th>
                        <th>Department</th>
                        <th>Requested_at</th>
                        <th>Sm Remark</th>
                        <th>Sm ID</th>
                        <th>Quantity</th>
                        <th>Rejected_at</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->request_by . "</td>
                                        <td>" . $department . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->created_at . "</td>
                                        <td>" . $request->sm_remark . "</td>
                                        <td>" . $request->store_manager . "</td>
                                        <td>" . $request->quantity . "</td>
                                        <td>" . $request->updated_at . "</td>
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

    public function fetchAllRejectReturnsHistoryPM(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->where('store_manager', $store_manager)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where('store_manager',$store_manager)->where(function ($query) use ($store_manager) {
        //         $query->where('status',2)
        //             ->orWhere('status',3);
        //     })
        //     ->get();

        $requests = ModelsRequest::where('isActive', 1)
            ->where('type',2)
            ->where(function ($query) use ($store_manager) {
                $query->where(function ($query) {
                        $query->where('status', 3);
                    });
            })
            ->get();


        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='show_rejected_returns' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity" . "<br>" . "_User</th>
                        <th>Remark</th>
                        <th>Requested_by ID</th>
                        <th>Requested_by</th>
                        <th>Department</th>
                        <th>Requested_at</th>
                        <th>Sm Remark</th>
                        <th>Sm ID</th>
                        <th>Quantity</th>
                        <th>Rejected_at</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->request_by . "</td>
                                        <td>" . $department . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->created_at . "</td>
                                        <td>" . $request->sm_remark . "</td>
                                        <td>" . $request->store_manager . "</td>
                                        <td>" . $request->quantity . "</td>
                                        <td>" . $request->updated_at . "</td>
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


    //to return issued items history
    public function fetchAllRequestsHistory(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->where('store_manager', $store_manager)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where('store_manager',$store_manager)->where(function ($query) use ($store_manager) {
        //         $query->where('status',2)
        //             ->orWhere('status',3);
        //     })
        //     ->get();

        $requests = ModelsRequest::where('type', 1)
            ->where('isActive', 1)
            ->where(function ($query) use ($store_manager) {
                $query->where('store_manager', $store_manager)
                    ->where(function ($query) {
                        $query->where('status', 2);
                    });
            })
            ->get();


        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_issued_items_data' class='display'>
                     <thead>
                         <tr>
                         <th>Request ID</th>
                         <th>Item_Id</th>
                         <th>Item</th>
                         <th>Quantity" . "<br>" . "_user</th>
                         <th>Remark</th>
                         <th>Requested_by ID</th>
                         <th>Requested_by</th>
                         <th>Department</th>
                         <th>Requested_at</th>
                         <th>Sm Remark</th>
                         <th>Quantity</th>
                         <th>Issued_at</th>
                         </tr>
                     </thead>
                     <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                                         <td>" . $request->id . "</td>
                                         <td>" . $request->item_user . "</td>
                                         <td>" . $itemName . "</td>
                                         <td>" . $request->quantity_user . "</td>
                                         <td>" . $request->user_remark . "</td>
                                         <td>" . $request->request_by . "</td>
                                         <td>" . $request->requestedByUser->name . "</td>
                                         <td>" . $department . "</td>
                                         <td>" . $request->created_at . "</td>
                                         <td>" . $request->sm_remark . "</td>
                                         <td>" . $request->quantity . "</td>
                                         <td>" . $request->updated_at . "</td>
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
    public function fetchAllRequestsHistoryPM(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->where('store_manager', $store_manager)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where('store_manager',$store_manager)->where(function ($query) use ($store_manager) {
        //         $query->where('status',2)
        //             ->orWhere('status',3);
        //     })
        //     ->get();

        $requests = ModelsRequest::where('type', 1)
            ->where('isActive', 1)
            ->where('status', 2)
            ->get();


        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_issued_items_data' class='display'>
                     <thead>
                         <tr>
                         <th>Request ID</th>
                         <th>Item_Id</th>
                         <th>Item</th>
                         <th>Quantity</th>
                         <th>Remark</th>
                         <th>Requested" . "<br>" . "_by Id</th>
                         <th>Requested_by</th>
                         <th>Requested_at</th>
                         <th>SM_Id</th>
                         <th>SM Name</th>
                         <th>SM_Remark</th>
                         <th>Quantity</th>
                         <th>Issued_at</th>
                         </tr>
                     </thead>
                     <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';

                $response .= "<tr>
                                         <td>" . $request->id . "</td>
                                         <td>" . $request->item_user . "</td>
                                         <td>" . $itemName . "</td>
                                         <td>" . $request->quantity_user . "</td>
                                         <td>" . $request->user_remark . "</td>
                                         <td>" . $request->request_by . "</td>
                                         <td>" . $request->requestedByUser->name . "</td>
                                         <td>" . $request->requested_timestamp . "</td>
                                         <td>" . $request->store_manager . "</td>
                                         <td>" . $request->storeManagerAttributes->name . "</td>
                                         <td>" . $request->sm_remark . "</td>
                                         <td>" . $request->quantity . "</td>
                                         <td>" . $request->updated_at . "</td>
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

    //for store manager. returns all return requests by users
    public function fetchAllReturnData(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        $requests = ModelsRequest::where('type', 2)->where('isActive', 1)->where('status', 0)->where('store_manager', null)->get();

        // $requests = ModelsRequest::where('type', 2)
        //     ->where('isActive', 1)->where(function ($query) use ($store_manager) {
        //         $query->where('store_manager', null)
        //             ->orWhere('store_manager', $store_manager);
        //     })
        //     ->get();

        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_returns_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Remark</th>
                        <th>Requested_by</th>
                        <th>Requested_at</th>
                        <th>Department</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->requested_timestamp . "</td>
                                        <td>" . $department . "</td>
                                        <td id='requestButtonContainer'><a href='#' id='$request->id.$request->item_user' class='processRequestButton btn-sm btn btn-primary' >Process</a>
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

    //for store manager. returns all processing request data under each sm
    public function fetchAllProcessingReturnData(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        $requests = ModelsRequest::where('type', 2)->where('isActive', 1)->where('status', 1)->where('store_manager', $store_manager)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where(function ($query) use ($store_manager) {
        //         $query->where('store_manager', null)
        //             ->orWhere('store_manager', $store_manager);
        //     })
        //     ->get();

        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_request_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Remark</th>
                        <th>Requested_by</th>
                        <th>Requested_at</th>
                        <th>Department</th>
                        <th>Processed_at</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->created_at . "</td>
                                        <td>" . $department . "</td>
                                        <td>" . $request->updated_at . "</td>
                                        <td id='requestButtonContainer'><a href='#' id='" . $request->id . "'  data-bs-toggle='modal' data-bs-target='#actionModal' class='actionRequestButton btn-sm btn btn-primary requestActionButton requestButtons'>Action</a>
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
    public function fetchAllProcessingReturnDataPM(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        $requests = ModelsRequest::where('type', 2)->where('isActive', 1)->where('status', 1)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where(function ($query) use ($store_manager) {
        //         $query->where('store_manager', null)
        //             ->orWhere('store_manager', $store_manager);
        //     })
        //     ->get();

        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_request_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Type</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Remark</th>
                        <th>Requested_by</th>
                        <th>Requested_at</th>
                        <th>SM_ID</th>
                        <th>SM</th>
                        <th>Processed_at</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->getTypeRequestAttribute() . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->requestedByUser->name . "</td>
                                        <td>" . $request->requested_timestamp . "</td>
                                        <td>" . $request->store_manager . "</td>
                                        <td>" . $request->storeManagerAttributes->name . "</td>
                                        <td>" . $request->updated_at . "</td>
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

    //to return accepted items history for Store manager
    public function fetchAllReturnsHistory(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->where('store_manager', $store_manager)->get();

        $requests = ModelsRequest::where('type', 2)
            ->where('isActive', 1)->where('store_manager', $store_manager)->where(function ($query) use ($store_manager) {
                $query->where('status', 2)
                    ->orWhere('status', 3);
            })
            ->get();

        $requests = ModelsRequest::where('type', 2)
            // ->where('isActive', 1)
            ->where('status', 2)
            ->get();


        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_accepted_items_data' class='display'>
                     <thead>
                         <tr>
                         <th>Request ID</th>
                         <th>Item_Id</th>
                         <th>Item</th>
                         <th>Quantity" . "<br>" . "_User</th>
                         <th>Remark</th>
                         <th>Requested_by Id</th>
                         <th>Requested_by</th>
                         <th>Department</th>
                         <th>Requested_at</th>
                         <th>SM_Remark</th>
                         <th>Quantity</th>
                         <th>Accepted At</th>
                         </tr>
                     </thead>
                     <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                                         <td>" . $request->id . "</td>
                                         <td>" . $request->item_user . "</td>
                                         <td>" . $itemName . "</td>
                                         <td>" . $request->quantity_user . "</td>
                                         <td>" . $request->user_remark . "</td>
                                         <td>" . $request->request_by . "</td>
                                         <td>" . $request->requestedByUser->name . "</td>
                                         <td>" . $department . "</td>
                                         <td>" . $request->created_at . "</td>
                                         <td>" . $request->sm_remark . "</td>
                                         <td>" . $request->quantity . "</td>
                                         <td>" . $request->updated_at . "</td>
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
    //to return accepted items history
    public function fetchAllReturnsHistoryPM(Request $request)
    {
        $store_manager = $request->sm_id;

        // // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->where('store_manager', $store_manager)->get();

        // $requests = ModelsRequest::where('type', 1)
        //     ->where('isActive', 1)->where('store_manager',$store_manager)->where(function ($query) use ($store_manager) {
        //         $query->where('status',2)
        //             ->orWhere('status',3);
        //     })
        //     ->get();

        $requests = ModelsRequest::where('type', 2)
            ->where('isActive', 1)
            ->where('status', 2)
            ->get();


        // Retrieve only active items
        // $requests = ModelsRequest::where('isActive', 1)->get();

        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_accepted_items_data' class='display'>
                     <thead>
                         <tr>
                         <th>Request ID</th>
                         <th>Item_Id</th>
                         <th>Item</th>
                         <th>Quantity</th>
                         <th>Remark</th>
                         <th>Requested_by" . "<br>" . "Id</th>
                         <th>Requested_by</th>
                         <th>Requested_at</th>
                         <th>SM Id</th>
                         <th>SM Name</th>
                         <th>Quantity</th>
                         <th>SM_Remark</th>
                         <th>Issued At</th>
                         </tr>
                     </thead>
                     <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';

                $response .= "<tr>
                                         <td>" . $request->id . "</td>
                                         <td>" . $request->item_user . "</td>
                                         <td>" . $itemName . "</td>
                                         <td>" . $request->quantity_user . "</td>
                                         <td>" . $request->user_remark . "</td>
                                         <td>" . $request->request_by . "</td>
                                         <td>" . $request->requestedByUser->name . "</td>
                                         <td>" . $request->requested_timestamp . "</td>
                                         <td>" . $request->store_manager . "</td>
                                         <td>" . $request->storeManagerAttributes->name . "</td>
                                         <td>" . $request->quantity . "</td>
                                         <td>" . $request->sm_remark . "</td>
                                         <td>" . $request->updated_at . "</td>
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




    public function RequestAction(Request $request)
    {
        $store_manager = $request->sm_id;
        $requestId = $request->requestId;

        // Find the request by requestId
        $itemRequest = ModelsRequest::where('id', $requestId)->first();

        if ($itemRequest) {
            // Update the sm_id
            $itemRequest->update([
                'store_manager' => $store_manager,
                'status' => 1,
            ]);

            // Alternatively, you can use the fill and save method
            // $itemRequest->fill(['sm_id' => $store_manager])->save();

            // Additional processing or response as needed
            return response()->json(['message' => 'store_manager updated successfully', 'status' => 200]);
        } else {
            // Handle the case where no matching record is found
            return response()->json(['error' => 'Request not found', 'status' => 404]);
        }
    }
    //fetch request data for reqeust action model
    public function dataForProcessModal(Request $request)
    {
        $request_id = $request->input('request_id');

        // Find the request by item_user
        $requestData = ModelsRequest::where('id', $request_id)->first();


        return response()->json($requestData);
    }

    public function processRequest(Request $request)
    {
        $store_manager = $request->store_manager;
        $quantity = $request->quantity;
        $sm_remark = $request->sm_remark;
        $currentTimestamp = now();
        $item_id = $request->item_id;
        $status = $request->request_status;
        $type = $request->request_type_hidden;
        //request type return or request
        $request_id = $request->request_id_hidden;

        //Get the user id from the request
        $request = ModelsRequest::find($request_id);
        $requesting_user = $request->request_by;

        if ($type == 1 && $status == 2) {
            // Update the availability column to 0
            $updated = Item::where('id', $item_id)->update([
                'availability' => 0,
                'owner' => $requesting_user,
                'flag_request' => NULL,
            ]);

            // if ($updated) {
            //     return response()->json(['message' => 'Availability updated successfully.']);
            // } else {
            //     return response()->json(['message' => 'Item not found.'], 404);
            // }
        } else if ($type == 2 && $status == 2) {
            // Update the availability column to 1
            $updated = Item::where('id', $item_id)->update([
                'availability' => 1,
                'owner' => NULL,
                'flag_return' => NULL,
            ]);
        }


        // Find the request by id
        $RequestRow = ModelsRequest::where('id', $request_id)->update([
            'status' => $status,
            'item_id' => $item_id,
            'quantity' => $quantity,
            'sm_remark' => $sm_remark,
            'store_manager' => $store_manager,
            'store_manager_timestamp' => $currentTimestamp,
        ]);

        if ($RequestRow) {
            // update the status
            return response()->json(['status' => 200, 'message' => "Request status done"]);
        }
    }

    //for user.to get user's requests history
    public function fetchMyRequestData(Request $request)
    {

        $user_id = $request->user_id;
        // Retrieve only active items
        $requests = ModelsRequest::where('isActive', 1)->where('request_by', $user_id)->where('type', 1)->get();


        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_request_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity" . "<br>" . "_User</th>
                        <th>Remark</th>
                        <th>Requested_at</th>
                        <th>SM</th>
                        <th>SM_Remark</th>
                        <th>Quantity</th>
                        <th>Processed_at</th>
                        <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $smName = $request->storeManagerAttributes ? $request->storeManagerAttributes->name : 'N/A';

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->created_at . "</td>
                                        <td>" . $smName . "</td>
                                        <td>" . $request->sm_remark . "</td>
                                        <td>" . $request->quantity . "</td>
                                        <td>" . $request->updated_at . "</td>
                                        <td>" . $request->getStatusRequestAttribute() . "</td>
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
    //for user. get return history
    public function fetchMyReturnData(Request $request)
    {

        $user_id = $request->user_id;
        // Retrieve only active items
        $requests = ModelsRequest::where('isActive', 1)->where('request_by', $user_id)->where('type', 2)->get();


        //returning data inside the table
        $response = '';

        if ($requests->count() > 0) {

            $response .=
                "<table id='all_return_data' class='display'>
                    <thead>
                        <tr>
                        <th>Request ID</th>
                        <th>Item_Id</th>
                        <th>Item</th>
                        <th>Quantity" . "<br>" . "_User</th>
                        <th>Remark</th>
                        <th>Requested_at</th>
                        <th>SM</th>
                        <th>SM_Remark</th>
                        <th>Quantity</th>
                        <th>Processed_at</th>
                        <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($requests as $request) {
                $itemName = $request->getItemById ? $request->getItemById->item_name : 'N/A';
                $smName = $request->storeManagerAttributes ? $request->storeManagerAttributes->name : 'N/A';

                $response .= "<tr>
                                        <td>" . $request->id . "</td>
                                        <td>" . $request->item_user . "</td>
                                        <td>" . $itemName . "</td>
                                        <td>" . $request->quantity_user . "</td>
                                        <td>" . $request->user_remark . "</td>
                                        <td>" . $request->created_at . "</td>
                                        <td>" . $smName . "</td>
                                        <td>" . $request->sm_remark . "</td>
                                        <td>" . $request->quantity . "</td>
                                        <td>" . $request->updated_at . "</td>
                                        <td>" . $request->getStatusRequestAttribute() . "</td>
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

    //for user. Items at the user
    public function fetchMyItems(Request $request)
    {
        $user_id = $request->user_id;

        // Retrieve item IDs that match the specified conditions
        $item_ids_with_owner = Item::where('availability', 0)
            ->where('owner', $user_id)
            ->pluck('id')
            ->toArray();

        // Retrieve the latest requests for each item that match the specified conditions
        $latestRequests = ModelsRequest::whereIn('item_id', $item_ids_with_owner)
            ->where('isActive', 1)
            ->whereIn('type', [1, 2])
            ->whereIn('status', [2, 3])
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('requests')
                    ->whereColumn('item_id', 'requests.item_id')
                    ->groupBy('item_id');
            })
            ->get();

        // Returning data inside the table
        $response = '';

        if ($latestRequests->count() > 0) {
            $response .= "<table id='all_myItem_data' class='display'>
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Item_Id</th>
                                <th>Item_name</th>
                                <th>User Remark</th>
                                <th>Quantity User</th>
                                <th>Requested_at</th>
                                <th>Sm Remark</th>
                                <th>Quantity</th>
                                <th>Issued_by</th>
                                <th>Issued_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

            foreach ($latestRequests as $request) {
                $itemName = $request->getItemNameById ? $request->getItemNameById->item_name : 'N/A';

                $response .= "<tr>
                            <td>" . $request->id . "</td>
                            <td>" . $request->item_id . "</td>
                            <td>" . $itemName . "</td>
                            <td>" . $request->user_remark . "</td>
                            <td>" . $request->quantity_user . "</td>
                            <td>" . $request->created_at . "</td>
                            <td>" . $request->sm_remark . "</td>
                            <td>" . $request->quantity . "</td>
                            <td>" . $request->storeManagerAttributes->name . "</td>
                            <td>" . $request->updated_at . "</td>
                            <td><a href='#' id='" . $request->item_id . "'  class='returnRequestButton  btn-sm btn btn-primary returnActionButton returnButtons'>Return</a></td>
                        </tr>";
            }

            $response .= "</tbody>
                    </table>";

            echo $response;
        } else {
            echo "<h3 align='center'>No Records in Database</h3>";
        }
    }

    //Not for users. All items now at users
    public function fetchItemsAtUsers(Request $request)
    {
        // Retrieve item IDs that match the specified conditions
        $item_ids_with_owner = Item::where('availability', 0)
            ->whereNotNull('owner')
            ->pluck('id')
            ->toArray();

        // Retrieve the latest requests for each item that match the specified conditions
        $latestRequests = ModelsRequest::whereIn('item_id', $item_ids_with_owner)
            ->where('isActive', 1)
            ->whereIn('type', [1, 2])
            ->whereIn('status', [2, 3])
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('requests')
                    ->whereColumn('item_id', 'requests.item_id')
                    ->groupBy('item_id');
            })
            ->get();

        // Returning data inside the table
        $response = '';

        if ($latestRequests->count() > 0) {
            $response .= "<table id='all_myItem_data' class='display'>
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>Item_Id</th>
                                <th>Item_name</th>
                                <th>Quantity</th>
                                <th>Owner Id</th>
                                <th>Owner</th>
                                <th>Department</th>
                                <th>Sm Remark</th>
                                <th>Issued_by</th>
                                <th>Issued_at</th>
                            </tr>
                        </thead>
                        <tbody>";

            foreach ($latestRequests as $request) {
                $itemName = $request->getItemNameById ? $request->getItemNameById->item_name : 'N/A';
                $department = $request->requestedByUser->departmentName;

                $response .= "<tr>
                            <td>" . $request->id . "</td>
                            <td>" . $request->item_id . "</td>
                            <td>" . $itemName . "</td>
                            <td>" . $request->quantity . "</td>
                            <td>" . $request->request_by . "</td>
                            <td>" . $request->requestedByUser->name . "</td>
                            <td>" . $department . "</td>
                            <td>" . $request->sm_remark . "</td>
                            <td>" . $request->storeManagerAttributes->name . "</td>
                            <td>" . $request->updated_at . "</td>
                        </tr>";
            }

            $response .= "</tbody>
                    </table>";

            echo $response;
        } else {
            echo "<h3 align='center'>No Records in Database</h3>";
        }
    }


    public function makeRequestReturn(Request $request)
    {
        $input = $request->validate([
            'request_by' => ['required'],
            'quantity_user' => ['required'],
            'user_remark' => ['required'],
            'item_user' => ['required'],
            'type' => ['required'],
            'status' => ['required'],
        ]);
        return DB::transaction(function () use ($input) {
            // Use Carbon to get the current timestamp
            $currentTimestamp = now();
            ModelsRequest::create([
                'item_user' => $input['item_user'],
                'quantity_user' => $input['quantity_user'],
                'user_remark' => $input['user_remark'],
                'request_by' => $input['request_by'],
                'requested_timestamp' => $currentTimestamp,
                'type' => $input['type'],
                'status' => $input['status'],
            ]);

            // Return the success response after the user is created
            return response()->json(['message' => 'New request created successfully.', 'status' => 200]);
        });
    }
}

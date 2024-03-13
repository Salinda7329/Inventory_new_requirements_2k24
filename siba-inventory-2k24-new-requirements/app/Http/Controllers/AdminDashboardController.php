<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('systemAdmin.system-admin-home');
    }

    public function fetchAllUserData()
    {

        $users = User::all();

        // return response()->json([
        //     'status' => $students,
        // ]);

        //returning data inside the table
        $response = '';

        if ($users->count() > 0) {

            $response .=
                "<table id='all_user_data' class='display'>
                    <thead>
                        <tr>
                        <th>User_ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Epf</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>";

            foreach ($users as $user) {
                $response .=
                    "<tr>
                            <td>" . $user->id . "</td>
                            <td>" . $user->email . "</td>
                            <td>";
                            if (Auth::check() && Auth::id() == $user->id) {
                                $response .= "<span style='color: green;'>{$user->name}</span>";
                            } else {
                                $response .= $user->name;
                            }

                $response .=
                            "</td>
                            <td>" . $user->getRoleNameAttribute() . "</td>
                            <td>" . $user->epf . "</td>
                           <td>" . $user->getDepartmentNameAttribute() . "</td>
                            <td>";
                            if ($user->isActive == 1) $response .= "<span style='color: green;'>Active</span>";
                            else if ($user->isActive == 2) $response .= "<span style='color: red;'>Deactivated</span>";
                            else $response .= "<span style='color: gray;'>Deleted</span>";

                $response .=
                            "</td>
                            <td><a href='#' id='" . $user->id . "'  data-bs-toggle='modal'
                            data-bs-target='#editUserDataModal' class='editUserButton'>Edit</a>
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

    public function edit(Request $request){
        $user_Id = $request->user_Id;
        //find data of id using Student model
        $user = User::find($user_Id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = User::find($request->user_Id_hidden);
        //   return response()->json($student);

        $user->update([
            'dept_id' => $request->dept_id,
            'role' => $request->role,
            'isActive' => $request->status,
        ]);

        return response()->json([
            'status' => 200,
        ]);
    }
}

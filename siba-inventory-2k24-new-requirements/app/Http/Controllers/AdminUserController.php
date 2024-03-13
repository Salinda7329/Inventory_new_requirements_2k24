<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Actions\Fortify\PasswordValidationRules;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Symfony\Contracts\Service\Attribute\Required;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckAdminRole');
    }

    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  Request  $request
     */
    public function create(Request $request)
    {
        try {
            $input = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'epf' => ['required', 'string', 'max:255', 'unique:users'],
                'dept_id' => ['required'],
                'role' => ['required'],
                'password' => $this->passwordRules(),
            ]);
            return DB::transaction(function () use ($input) {
                User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'epf' => $input['epf'],
                    'dept_id' => $input['dept_id'],
                    'role' => $input['role'],
                    'password' => Hash::make($input['password'])
                ]);

                // Return the success response after the user is created
                return response()->json(['message' => 'New user created successfully.', 'status' => 200]);
            });
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors(), 'status' => 422]);
        } catch (QueryException $e) {
            // Log the error if needed: \Log::error($e);

            return response()->json(['error' => 'Failed to create user.', 'status' => 500]);
        }
    }
}

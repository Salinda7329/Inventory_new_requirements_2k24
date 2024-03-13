<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CheckUserActivity
{
    public function __invoke(Request $request, $next)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password) && $user->isActive == 1) {
            return $next($request);
        }

        // return Redirect::back()->withErrors(['error' => 'Your account is currently inactive.']);
        return view('errors.accountDeactivated');
    }
}

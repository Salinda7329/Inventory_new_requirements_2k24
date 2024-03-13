<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, string ...$guards): Response
    // {
    //     $guards = empty($guards) ? [null] : $guards;

    //     foreach ($guards as $guard) {
    //         if (Auth::guard($guard)->check()) {
    //             return redirect(RouteServiceProvider::HOME);
    //         }
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $role = Auth::user()->role;

            switch ($role) {
                // System admin
                case 5:
                    return 'systemAdmin.home';
                // head of administration
                case 4:
                // purchasing manager
                case 3:
                    return 'pm.home';
                // store manager
                case 2:
                    return 'storeManager.home';
                // user
                case 1:
                    return 'user.home';
            }
        }
        return $next($request);
    }
}

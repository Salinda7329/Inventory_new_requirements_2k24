<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectToHomeBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            switch (Auth::user()->role) {
                case '5':
                    return redirect('/systemAdmin/home');
                case '4':
                    return redirect('/headOfAdministration/home');
                case '3':
                    return redirect('/pm/home');
                case '2':
                    return redirect('/storeManager/home');
                case '1':
                    return redirect('/user/home');
                default:
                    return redirect()->back();
            }
        }

        return $next($request);
    }
}

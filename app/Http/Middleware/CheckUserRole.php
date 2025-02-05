<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in
        if ($request->user()) {
            // If user is an admin, continue to the admin routes
            if ($request->user()->is_admin) {
                return $next($request); // Admin route access allowed
            }

            // If the user is not an admin, redirect to user routes
            return redirect()->route('user.two-factor'); // Redirect to the user 2FA route
        }

        // If no user is logged in, you can redirect to login page or show error
        return redirect()->route('login');
    }
}

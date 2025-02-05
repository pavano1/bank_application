<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Illuminate\Support\Facades\Session;


class TwoFactorAuthenticationController extends Controller
{
    public function show()
    {
        if (Auth::user()->is_admin) {
            return view('admin.two-factor'); // Admin 2FA page
        } else {
            return view('user.two-factor'); // User 2FA page
        } // Show the 2FA input form
    }

    public function store(Request $request)
    {
        // Validate the input (ensure the token is a 6-digit number)
        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);
        // Get the token stored in the session
        $sessionToken = Session::get('2fa_token');
        // Check if the entered code matches the one stored in the session
        if ($request->code == $sessionToken) {
            // Mark the user as having confirmed 2FA
            $user = Auth::user();
            $user->markTwoFactorAsConfirmed();  // this method set up for marking the 2FA confirmation
            // Clear the 2FA code from the session to prevent reuse
            Session::forget('2fa_token');
            // Redirect to the intended route after successful verification
            if ($user->is_admin) {
                // If user is an admin, redirect to the admin dashboard
                return redirect()->route('admin.dashboard'); // Adjust route name if needed
            } else {
                // If user is not an admin, redirect to the user dashboard
                return redirect()->route('user.dashboard'); // Adjust route name if needed
            }
        }
        // If the code doesn't match, return back with an error
        return back()->withErrors(['code' => 'Invalid two-factor code.']);
    }
}

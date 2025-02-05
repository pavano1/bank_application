<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Laravel\Fortify\Contracts\TwoFactorAuthenticatable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\TwoFactorAuthEmail;
use Illuminate\Support\Facades\Session;




class LoginController extends Controller
{
    public function showLoginForm()
    {

        return  view('auth.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $validator = Validator::make($credentials, [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Find the user by email
        $user = User::where('email', $request->email)->first();
        // Check if the user exists and the password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user); // Login the user
            // If the user has two-factor authentication enabled
            if ($user->hasEnabledTwoFactorAuthentication()) {
                $this->sendTwoFactorCode($user);
                // Redirect to the 2FA verification page
                if ($user->is_admin) {
                    return redirect()->route('admin.two-factor'); // admin 2FA page
                } else {
                    return redirect()->route('user.two-factor'); // Redirect to user 2FA page
                }
            } else {
                // If no 2FA, redirect to the intended route (or home/dashboard)
                return redirect()->intended(route('dashboard')); // Adjust the route as needed
            }
        }
        // redirect back to the login page with an error message for invalid credentails
        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    // Method to send the 2FA token
    private function sendTwoFactorCode($user)
    {
        // Generate a 2FA token (6 digits)
        $token = mt_rand(100000, 999999);
        // Store the token in the session
        Session::put('2fa_token', $token);
        // Send the 2FA token to the user via email
        Mail::to($user->email)->send(new TwoFactorAuthEmail($token, $user->email));
    }
    public function logout()
    {
        Auth::logout();
        // Clear the session
        session()->invalidate();
        session()->regenerateToken();
        // Flash a message to inform the user about logout
        session()->flash('message', 'You have been logged out.');
        // Add headers to prevent caching
        return redirect()->route('login')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, proxy-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }
}

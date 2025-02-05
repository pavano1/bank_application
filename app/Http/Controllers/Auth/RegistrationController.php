<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.registration');
    }

    // Handle the registration process
    public function register(Request $request)
    {

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the new user
        $isAdmin = User::count() === 0;  // Check if no users exist (first user)

        // Create the new user
        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->confirm_password = Hash::make($request->confirm_password);
        $user->is_admin = $isAdmin;  // Set is_admin based on the first user condition

        // Save the user
        $user->save();
        return redirect()->route('login');
    }
}

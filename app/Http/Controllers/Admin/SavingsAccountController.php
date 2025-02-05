<?php

// app/Http/Controllers/Admin/SavingsAccountController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingsAccount;
use Illuminate\Http\Request;
use App\Models\User;


class SavingsAccountController extends Controller
{
    public function create()
    {
        $users = User::where('is_admin', false)->get(); // Exclude admins
        return view('admin.create_savings_accounts', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'first_name.*' => 'required|string|max:255',
            'last_name.*' => 'required|string|max:255',
            'dob.*' => 'required|date',
            'address.*' => 'required|string|max:255',
            'balance.*' => 'nullable|numeric|min:0', // Validate balance
            'user_id.*' => 'required|exists:users,id', // Ensure that each user exists
        ]);
        // Loop through each account and create it
        for ($i = 0; $i < count($request->first_name); $i++) {
            // Check if the user already has a savings account
            $user = User::find($request->user_id[$i]);
            // If the user already has a savings account, skip creating a new one
            if ($user->savingsAccount()->exists()) {
                return redirect()->route('admin.create_savings_accounts')->with('error', 'User already has a savings account.');
            }
            // Generate a random 16-digit account number
            $accountNumber = $this->generateAccountNumber();
            // Determine balance (use the provided balance, or default to 10,000 INR)
            $balance = $request->balance[$i] ?? 10000;
            // Create the Savings Account
            SavingsAccount::create([
                'account_number' => $accountNumber, // Generated unique 16-digit account number
                'first_name' => $request->first_name[$i],
                'last_name' => $request->last_name[$i],
                'dob' => $request->dob[$i],
                'address' => $request->address[$i],
                'user_id' => $request->user_id[$i], // Foreign key reference to the User
                'balance' => $balance, // Set the balance (either from form or default to 10,000 INR)
                'currency' => 'INR', // Set the default currency as INR
            ]);
        }
       
        return redirect()->route('admin.accounts')->with('success', 'Savings accounts created successfully.');
    }

    // Generate a unique 16-digit account number
    private function generateAccountNumber()
    {
        // Generate a random 16-digit number
        $accountNumber = '';
        do {
            $accountNumber = str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT);
        } while (SavingsAccount::where('account_number', $accountNumber)->exists()); // Ensure uniqueness
        return $accountNumber;
    }

    public function showAccounts()
    {
        // Check if the user is an admin
        if (auth()->user()->is_admin) {
            // If the user is an admin, show all accounts
            $accounts = SavingsAccount::all();
            return view('admin.account_details', compact('accounts'));
        }
        // If the user is not an admin, show only their account
        $userAccount = auth()->user()->savingsAccount;
        return view('user.account_details', compact('userAccount'));
    }
}

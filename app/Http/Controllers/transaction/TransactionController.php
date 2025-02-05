<?php

namespace App\Http\Controllers\transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SavingsAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class TransactionController extends Controller
{
    public function create()
    {
        // Retrieve all savings accounts
        $savingsAccounts = SavingsAccount::all();
        return view('transaction.transfer_form', compact('savingsAccounts'));
    }

    public function store(Request $request)
    {

        // Validate the incoming request data (optional but recommended)
        $validated = $request->validate([
            'from_savings_account_id' => 'required|exists:savings_accounts,id',
            'to_savings_account_id' => 'required|exists:savings_accounts,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
        ]);

        // Retrieve the savings accounts involved
        $fromAccount = SavingsAccount::find($request->from_savings_account_id);
        $toAccount = SavingsAccount::find($request->to_savings_account_id);

        // Check if the from account has enough balance
        if ($fromAccount->balance < $request->amount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        // Begin a transaction to ensure the atomicity of the operation
        \DB::beginTransaction();

        try {
            // Debit the 'from' account
            $fromAccount->balance -= $request->amount;
            $fromAccount->save(); // Save the updated balance

            // Credit the 'to' account
            $toAccount->balance += $request->amount;
            $toAccount->save(); // Save the updated balance

            // Create the transaction record
            $transaction = Transaction::create([
                'debited_savings_account_id' => $fromAccount->id,
                'credited_savings_account_id' => $toAccount->id,
                'amount' => $request->amount,
                'currency' => $request->currency,
                //  'savings_account_id' => Auth::user()->savingsAccount->id, // Assuming user has a savings account
            ]);

            // Commit the transaction
            \DB::commit();

            // Return the successful response
            return response()->json(['transaction' => $transaction], 201);
        } catch (\Exception $e) {
            // If anything fails, rollback the transaction
            \DB::rollBack();
            return response()->json(['error' => 'Transaction failed', 'message' => $e->getMessage()], 500);
        }
    }




    public function show()
    {
        $transactions = Transaction::with('savingsAccount')->get();

        // Pass the transactions to the view
        return view('transaction.transaction_history', compact('transactions'));
    }
}

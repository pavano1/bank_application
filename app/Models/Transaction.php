<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
protected $fillable = [
        'debited_savings_account_id',
        'credited_savings_account_id',
        'amount',
        'currency',
       // 'savings_account_id',
    ];
    // Define relationships for the transaction
    public function debitedAccount()
    {
        return $this->belongsTo(SavingsAccount::class, 'debited_savings_account_id');
    }

    public function creditedAccount()
    {
        return $this->belongsTo(SavingsAccount::class, 'credited_savings_account_id');
    }

    public function savingsAccount()
    {
        return $this->belongsTo(SavingsAccount::class, 'savings_account_id');
    }
}

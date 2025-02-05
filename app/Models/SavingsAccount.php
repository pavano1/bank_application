<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingsAccount extends Model
{
    use HasFactory;
     
    // The attributes that are mass assignable
    protected $fillable = [
        'account_number', 
        'first_name', 
        'last_name', 
        'dob', 
        'address', 
        'balance', 
        'currency', 
        'user_id',
    ];

    // One-to-one relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Auto-generate account number before creating the account
    protected static function booted()
    {
        static::creating(function ($account) {
            // Generate a random 16-digit account number
            if (!$account->account_number) {
                $account->account_number = rand(1000000000000000, 9999999999999999);
            }
        });
    }
}

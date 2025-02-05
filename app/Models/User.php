<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable; // Use the correct trait
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_confirmed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
   

  public function isAdmin()
    {
        return $this->is_admin;  // Assuming `is_admin` is a column in your `users` table
    }

     public function hasEnabledTwoFactorAuthentication()
    {
       return $this->two_factor_secret !== null;
    }
     /**
     * Check if the provided 2FA code is valid.
     *
     * @param  string  $code
     * @return bool
     */
    public function hasValidTwoFactorCode($code)
    {
        return app(TwoFactorAuthenticationServices::class)->verify($this, $code);
    }

    /**
     * Check if the provided recovery code is valid.
     *
     * @param  string  $recoveryCode
     * @return bool
     */
    public function hasValidRecoveryCode($recoveryCode)
    {
        return in_array($recoveryCode, $this->recoveryCodes());
    }

    /**
     * Get the recovery codes for the user.
     *
     * @return array
     */
    public function recoveryCodes()
    {
        // Return the recovery codes for this user.
        // You should have a `two_factor_recovery_codes` column in your `users` table.
        return explode(',', $this->two_factor_recovery_codes);
    }

    /**
     * Mark the user as having confirmed two-factor authentication.
     *
     * @return void
     */
    public function markTwoFactorAsConfirmed()
    {
        
      Log::info('Updating two_factor_confirmed_at for user ID: ' . $this->id);

    $this->update([
        'two_factor_confirmed_at' => now(),
    ]);

    // Log the query to check if it's being executed
    DB::enableQueryLog();
    $this->update([
        'two_factor_confirmed_at' => now(),
    ]);
    Log::info(DB::getQueryLog());
    }
 public function savingsAccount()
    {
        return $this->hasOne(SavingsAccount::class);
    }

}

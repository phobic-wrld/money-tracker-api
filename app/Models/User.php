<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        // Removed password as the assessment says "no authentication required"
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * RELATIONSHIP: A user can have many wallets.
     */
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * ACCESSOR: This creates a virtual "total_balance" field.
     * When you call $user->total_balance, it sums up all wallet balances.
     */
    public function getTotalBalanceAttribute()
    {
        // This sums the 'balance' attribute defined in your Wallet model
        return $this->wallets->sum(function ($wallet) {
            return $wallet->balance;
        });
    }

    /**
     * This tells Laravel to include 'total_balance' automatically 
     * when converting the user object to JSON for your API.
     */
    protected $appends = ['total_balance'];
}
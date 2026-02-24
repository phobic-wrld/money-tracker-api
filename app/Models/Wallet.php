<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * We need user_id to link it to a user, and name for the wallet label.
     */
    protected $fillable = [
        'user_id', 
        'name'
    ];

    /**
     * RELATIONSHIP: A wallet belongs to one user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * RELATIONSHIP: A wallet has many transactions (incomes and expenses).
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * ACCESSOR: This calculates the current balance of the wallet.
     * Balance = (Sum of all incomes) - (Sum of all expenses)
     */
    public function getBalanceAttribute()
    {
        $income = $this->transactions()->where('type', 'income')->sum('amount');
        $expense = $this->transactions()->where('type', 'expense')->sum('amount');

        return $income - $expense;
    }

    /**
     * This ensures the 'balance' field is included automatically 
     * when the wallet is sent as a JSON response to the frontend.
     */
    protected $appends = ['balance'];
}
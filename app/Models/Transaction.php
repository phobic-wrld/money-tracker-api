<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * wallet_id: links the transaction to a specific wallet.
     * amount: the value of the transaction.
     * type: must be 'income' or 'expense'.
     * description: what the transaction was for.
     */
    protected $fillable = [
        'wallet_id', 
        'amount', 
        'type', 
        'description'
    ];

    /**
     * RELATIONSHIP: A transaction belongs to one specific wallet.
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
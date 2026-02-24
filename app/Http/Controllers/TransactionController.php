<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Requirement: Add transactions (Income or Expense)
     */
    public function store(Request $request)
    {
        // Technical Requirement: Basic validation (Required, Positive amount, Valid type)
        $validated = $request->validate([
            'wallet_id'   => 'required|exists:wallets,id',
            'amount'      => 'required|numeric|min:0.01', // Positive amounts only
            'type'        => 'required|in:income,expense', // Valid transaction type
            'description' => 'nullable|string|max:255',
        ]);

        $transaction = Transaction::create($validated);

        return response()->json($transaction, 201);
    }
}
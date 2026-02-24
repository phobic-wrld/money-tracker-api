<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Requirement: Create one or more wallets
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
        ]);

        $wallet = Wallet::create($validated);

        return response()->json($wallet, 201);
    }

    /**
     * Requirement: Select a single wallet to view (Balance + All transactions)
     */
    public function show(Wallet $wallet)
    {
        // Load the transactions for this specific wallet
        return response()->json($wallet->load('transactions'));
    }
}
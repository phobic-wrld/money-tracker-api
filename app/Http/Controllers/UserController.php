<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Requirement: Create a user account (no authentication required)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    /**
     * Requirement: View profile (All wallets, each wallet balance, total overall balance)
     */
    public function show(User $user)
    {
        // We load the wallets relationship. 
        // Because of the 'appends' in our models, 
        // balances are calculated automatically.
        return response()->json($user->load('wallets'));
    }
}
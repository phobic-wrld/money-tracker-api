<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// User Routes
// 1. Create a user
Route::post('/users', [UserController::class, 'store']);
// 2. View user profile (includes all wallets and total balance)
Route::get('/users/{user}', [UserController::class, 'show']);

// Wallet Routes
// 3. Create a wallet for a user
Route::post('/wallets', [WalletController::class, 'store']);
// 4. View specific wallet (includes balance and transactions)
Route::get('/wallets/{wallet}', [WalletController::class, 'show']);

// Transaction Routes
// 5. Add a transaction (Income or Expense) to a wallet
Route::post('/transactions', [TransactionController::class, 'store']);
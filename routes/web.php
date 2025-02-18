<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HomeController;

// Halaman Utama
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $totalProducts = \App\Models\Product::count();
        $totalIn = \App\Models\Transaction::where('type', '=', 'in')->count();
        $totalOut = \App\Models\Transaction::where('type', '=', 'out')->count();
        return view('dashboard', compact('totalProducts', 'totalIn', 'totalOut'));
    })->name('dashboard');

    // Routes untuk Products
    Route::resource('products', ProductController::class);

    // Routes untuk Categories
    Route::resource('categories', CategoryController::class);

    // Routes untuk Transactions
    Route::resource('transactions', TransactionController::class);
});

// Authentication Routes
Auth::routes();

// Redirect /home ke /dashboard
Route::get('/home', function() {
    return redirect()->route('dashboard');
})->name('home');

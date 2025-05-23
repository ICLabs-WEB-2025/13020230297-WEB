<?php

use App\Http\Controllers\MembershipCardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

require __DIR__ . '/auth.php';

Route::get('/cards/download/{id}', [CardController::class, 'download'])->name('card.download');

// Redirect root ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});


// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Protected routes (memerlukan authentication)
Route::middleware(['auth'])->group(function () {

    // Membership Cards CRUD routes
    Route::resource('membership_cards', MembershipCardController::class);

    // Card generation routes (menggunakan CardController yang sudah diperbaiki)
    Route::get('/cards/print/{id}', [CardController::class, 'print'])->name('cards.print');
    Route::get('/cards/download/{id}', [CardController::class, 'download'])->name('cards.download');

    // Optional: redirect cards route ke dashboard
    Route::get('/cards', [CardController::class, 'show'])->name('cards.show');
});

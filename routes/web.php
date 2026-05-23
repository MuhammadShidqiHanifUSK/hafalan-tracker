<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetoranController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('setoran', SetoranController::class);
});

require __DIR__.'/settings.php';
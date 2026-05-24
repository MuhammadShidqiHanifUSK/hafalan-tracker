<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetoranController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('setoran', SetoranController::class);
    Route::patch('setoran/{id}/paraf-guru', [SetoranController::class, 'parafGuru'])->name('setoran.paraf-guru');
    Route::patch('setoran/{id}/paraf-ortu', [SetoranController::class, 'parafOrtu'])->name('setoran.paraf-ortu');
});

require __DIR__.'/settings.php';
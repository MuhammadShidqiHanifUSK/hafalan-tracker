<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatatanSetoranController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {

    // Redirect setelah login sesuai role
    Route::get('/redirect-after-login', function () {
        $role = auth()->user()->role;
        return redirect(match($role) {
            'admin'  => '/admin/users',
            'ustadz' => '/setoran',
            'santri' => '/riwayat',
            'ortu'   => '/setoran-anak',
            default  => '/dashboard',
        });
    });


    // Route khusus admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('admin/users', AdminController::class)->names('admin');
    });

    // Route khusus ustadz
    Route::middleware(['role:ustadz'])->group(function () {
        Route::resource('setoran', SetoranController::class);
        Route::patch('setoran/{id}/paraf-guru', [SetoranController::class, 'parafGuru'])->name('setoran.paraf-guru');
        Route::get('santri/{santriId}/riwayat', [SetoranController::class, 'riwayatSantri'])->name('setoran.riwayat-santri');
    });

    // Route khusus ortu
    Route::middleware(['role:ortu'])->group(function () {
        Route::get('setoran-anak', [OrtuController::class, 'index'])->name('ortu.index');
        Route::get('setoran-anak/{id}', [OrtuController::class, 'show'])->name('ortu.show');
        Route::patch('setoran-anak/{id}/paraf', [OrtuController::class, 'parafOrtu'])->name('ortu.paraf');
    });

    // Route khusus santri
    Route::middleware(['role:santri'])->group(function () {
        Route::get('riwayat', [SantriController::class, 'index'])->name('santri.index');
        Route::get('riwayat/{id}', [SantriController::class, 'show'])->name('santri.show');
    });

    // Route catatan (ustadz & ortu)
    Route::middleware(['role:ustadz,ortu'])->group(function () {
        Route::post('setoran/{setoranId}/catatan', [CatatanSetoranController::class, 'store'])->name('catatan.store');
    });

});

require __DIR__.'/settings.php';
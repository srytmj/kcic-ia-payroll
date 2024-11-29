<?php

use App\Http\Controllers\ProfileController;
use App\Models\Bak;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// data

// document
use App\Http\Controllers\Document\BakController;
use App\Http\Controllers\Document\RekeningkoranController;

Route::prefix('farebox')->group( function () {
    // data
    Route::prefix('data')->group(function () {
        //
    });

    
    // document
    Route::prefix('document')->group(callback: function () {
        Route::resource('bak', BakController::class);
        Route::get('/bak/pdf/{id}', function($id) {
            $dokumen = Bak::findOrFail($id); // Mengambil data berdasarkan ID
            $filePath = storage_path('app/public/' . $dokumen->file_path); // Lokasi file
        
            if (file_exists($filePath)) {
                return response()->file($filePath); // Kirim file ke browser
            }
        
            abort(404); // Kalau file nggak ada, tampilkan 404
        });
        Route::put('/bak/{id}', [BakController::class, 'update'])->name('bak.update');

        
        Route::get('/bak/{id}/download', [BakController::class, 'download'])->name('bak.download');

        Route::resource('rekeningkoran', RekeningkoranController::class);
        Route::get('/rekeningkoran/pdf/{id}', [RekeningkoranController::class, 'getPdf'])->name('rekeningkoran.pdf');
        Route::get('/rekeningkoran/{id}/download', [RekeningkoranController::class, 'download'])->name('rekeningkoran.download');

        // Route::post('/farebox/document/bak/store', [BakController::class, 'store'])->name('bak.store');
        // Route::delete('/delete-selected', [BakController::class, 'deleteSelected'])->name('delete.selected');
    });
});


require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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

//farebox
// data
use App\Http\Controllers\Farebox\data\FareboxController;
use App\Http\Controllers\Farebox\data\RefundrombonganController;   

// document
use App\Http\Controllers\Farebox\Document\BakController;
use App\Http\Controllers\Farebox\Document\RekeningkoranController;

Route::prefix('farebox')->group( function () {
    // data
    Route::prefix('data')->group(function () {
        Route::resource('farebox', FareboxController::class);
        Route::resource('refundrombongan', RefundrombonganController::class);
    });

    
    // document
    Route::prefix('document')->group(function () {
        Route::resource('bak', BakController::class);
        Route::post('/farebox/document/bak', [BakController::class, 'store'])->name('document.store');
        Route::delete('/delete-selected', [BakController::class, 'deleteSelected'])->name('delete.selected');

        Route::resource('rekeningkoran', RekeningkoranController::class);
    
    });
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use App\Models\Bak;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

use App\Http\Controllers\Dashboard;
Route::get('/dashboard', [Dashboard::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/penjualan/periode', [Dashboard::class, 'totalPenjualanPerPeriode']);
Route::get('/penjualan/hari', [Dashboard::class, 'totalPenjualanPerHari']);
Route::get('/penjualan/seat-class', [Dashboard::class, 'totalPenjualanPerSeatClass']);
Route::get('/penjualan/stasiun', [Dashboard::class, 'countPenjualanPerStasiun']);
Route::get('/test', action: [Dashboard::class, 'test'])->middleware(['auth', 'verified'])->name('test');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// data

// document
use App\Http\Controllers\Document\BakController;
use App\Http\Controllers\Document\RekeningkoranController;
use App\Http\Controllers\Data\TicketsalesController;

// data
Route::prefix('data')->group(function () {
    
    // Route to handle the ticket update
    Route::resource('ticketsales', TicketsalesController::class);


});


// document
Route::prefix('document')->group(callback: function () {
    Route::resource('bak', BakController::class);
    Route::get('/bak/pdf/{id}', function ($id) {
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

    // Route::post('/document/bak/store', [BakController::class, 'store'])->name('bak.store');
    // Route::delete('/delete-selected', [BakController::class, 'deleteSelected'])->name('delete.selected');
});

use App\Http\Controllers\ClassificationController;

Route::get('/classification/create/{id}', [ClassificationController::class, 'create'])->name('classification.create');
Route::resource('classification', ClassificationController::class);
Route::post('/process-selected-data', [ClassificationController::class, 'processSelectedData'])->name('process.selected.data');
Route::post('/update-ticket-sales', [ClassificationController::class, 'updateTicketSales']);

use App\Http\Controllers\Rekapitulasi;
Route::get('/rekapitulasi/bak', [Rekapitulasi::class, 'bak'])->name('rekapitulasi.bak');
Route::get('/rekapitulasi/ticketsales', [Rekapitulasi::class, 'ticketsales'])->name('rekapitulasi.ticketsales');
Route::get('/rekapitulasi/refundrombongan', [Rekapitulasi::class, 'refundrombongan'])->name('rekapitulasi.refundrombongan');
Route::get('/export-csv', [Rekapitulasi::class, 'exportCsv'])->name('export.csv');
Route::get('/export-csv-ticketsales', [Rekapitulasi::class, 'exportCsvTicketsales'])->name('export.csv.ticketsales');

require __DIR__ . '/auth.php';

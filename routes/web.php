<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanSuratController;

Route::get('/', function () {
    return redirect('/admin');
});

// Route Cetak PDF
Route::get('/laporan/surat-masuk', [LaporanSuratController::class, 'suratMasuk'])
    ->name('laporan.surat-masuk');

Route::get('/laporan/disposisi', [LaporanSuratController::class, 'disposisi'])
    ->name('laporan.disposisi');

// Route Export Excel (CSV)
Route::get('/laporan/surat-masuk/excel', [LaporanSuratController::class, 'exportExcelSuratMasuk'])
    ->name('laporan.surat-masuk.excel');

Route::get('/laporan/disposisi/excel', [LaporanSuratController::class, 'exportExcelDisposisi'])
    ->name('laporan.disposisi.excel');
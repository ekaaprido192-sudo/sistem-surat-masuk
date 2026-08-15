<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanSuratController;
use App\Models\Disposisi;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/admin');
});


/*
|--------------------------------------------------------------------------
| Laporan Surat Masuk
|--------------------------------------------------------------------------
*/

Route::get(
    '/laporan/surat-masuk',
    [LaporanSuratController::class, 'suratMasuk']
)->name('laporan.surat-masuk');


/*
|--------------------------------------------------------------------------
| Laporan Disposisi
|--------------------------------------------------------------------------
*/

Route::get(
    '/laporan/disposisi',
    [LaporanSuratController::class, 'disposisi']
)->name('laporan.disposisi');


/*
|--------------------------------------------------------------------------
| Export Excel Surat Masuk
|--------------------------------------------------------------------------
*/

Route::get(
    '/laporan/surat-masuk/excel',
    [LaporanSuratController::class, 'exportExcelSuratMasuk']
)->name('laporan.surat-masuk.excel');


/*
|--------------------------------------------------------------------------
| Export Excel Disposisi
|--------------------------------------------------------------------------
*/

Route::get(
    '/laporan/disposisi/excel',
    [LaporanSuratController::class, 'exportExcelDisposisi']
)->name('laporan.disposisi.excel');


/*
|--------------------------------------------------------------------------
| Cetak Lembar Disposisi Fisik (Per Surat)
|--------------------------------------------------------------------------
*/

Route::get('/admin/disposisi/{id}/cetak', function ($id) {
    $disposisi = Disposisi::with('suratMasuk')->findOrFail($id);
    $pdf = Pdf::loadView('laporan.lembar-disposisi', compact('disposisi'));
    return $pdf->stream('Lembar-Disposisi-' . ($disposisi->suratMasuk->nomor_agenda ?? $disposisi->id) . '.pdf');
})->name('disposisi.cetak');
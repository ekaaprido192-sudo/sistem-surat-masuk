<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Disposisi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanSuratController extends Controller
{
    /**
     * Cetak PDF Laporan Surat Masuk berdasarkan Filter Tanggal
     */
    public function suratMasuk(Request $request)
    {
        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');

        $query = SuratMasuk::query();

        if ($tglMulai && $tglSelesai) {
            $query->whereDate('tanggal_surat', '>=', $tglMulai)
                  ->whereDate('tanggal_surat', '<=', $tglSelesai);
        }

        $suratMasuk = $query->latest()->get();

        $pdf = Pdf::loadView('laporan.surat-masuk', [
            'suratMasuk'  => $suratMasuk,
            'tglMulai'    => $tglMulai,
            'tglSelesai'  => $tglSelesai,
        ]);

        return $pdf->stream('laporan-surat-masuk.pdf');
    }

    /**
     * Cetak PDF Laporan Disposisi berdasarkan Filter Tanggal
     */
    public function disposisi(Request $request)
    {
        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');

        $query = Disposisi::query();

        if ($tglMulai && $tglSelesai) {
            $query->whereDate('created_at', '>=', $tglMulai)
                  ->whereDate('created_at', '<=', $tglSelesai);
        }

        $disposisi = $query->latest()->get();

        $pdf = Pdf::loadView('laporan.disposisi', [
            'disposisi'  => $disposisi,
            'tglMulai'   => $tglMulai,
            'tglSelesai' => $tglSelesai,
        ]);

        return $pdf->stream('laporan-disposisi.pdf');
    }

    /**
     * Export CSV / Excel Laporan Surat Masuk
     */
    public function exportExcelSuratMasuk(Request $request)
    {
        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');

        $query = SuratMasuk::query();

        if ($tglMulai && $tglSelesai) {
            $query->whereDate('tanggal_surat', '>=', $tglMulai)
                  ->whereDate('tanggal_surat', '<=', $tglSelesai);
        }

        $suratMasuk = $query->latest()->get();

        $filename = "laporan-surat-masuk-" . date('Y-m-d') . ".csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $handle = fopen('php://output', 'w');

        // Header Kolom Excel
        fputcsv($handle, ['No', 'No Surat', 'Tanggal Surat', 'Pengirim', 'Perihal']);

        foreach ($suratMasuk as $index => $row) {
            fputcsv($handle, [
                $index + 1,
                $row->no_surat,
                $row->tanggal_surat,
                $row->pengirim ?? '-',
                $row->perihal,
            ]);
        }

        fclose($handle);
        exit;
    }

    /**
     * Export CSV / Excel Laporan Disposisi
     */
    public function exportExcelDisposisi(Request $request)
    {
        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');

        $query = Disposisi::query();

        if ($tglMulai && $tglSelesai) {
            $query->whereDate('created_at', '>=', $tglMulai)
                  ->whereDate('created_at', '<=', $tglSelesai);
        }

        $disposisi = $query->latest()->get();

        $filename = "laporan-disposisi-" . date('Y-m-d') . ".csv";

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $handle = fopen('php://output', 'w');

        // Header Kolom Excel
        fputcsv($handle, ['No', 'Tanggal Disposisi', 'Tujuan / Penerima', 'Isi Disposisi']);

        foreach ($disposisi as $index => $row) {
            fputcsv($handle, [
                $index + 1,
                $row->created_at ? $row->created_at->format('Y-m-d') : '-',
                $row->tujuan ?? $row->penerima ?? '-',
                $row->isi_disposisi ?? $row->catatan ?? '-',
            ]);
        }

        fclose($handle);
        exit;
    }
}
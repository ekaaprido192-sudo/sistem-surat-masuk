<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use App\Models\Disposisi;
use App\Exports\SuratMasukExport;
use App\Exports\DisposisiExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class LaporanSuratController extends Controller
{
    /**
     * Cetak PDF Laporan Surat Masuk
     */
    public function suratMasuk(Request $request)
    {
        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');

        $query = SuratMasuk::query();

        if ($tglMulai && $tglSelesai) {
            $query->whereBetween('tanggal_surat', [
                $tglMulai,
                $tglSelesai
            ]);
        }

        $suratMasuk = $query
            ->orderBy('tanggal_surat', 'asc')
            ->get();

        $pdf = Pdf::loadView('laporan.surat-masuk', [
            'suratMasuk' => $suratMasuk,
            'tglMulai' => $tglMulai,
            'tglSelesai' => $tglSelesai,
        ]);

        return $pdf->stream('laporan-surat-masuk.pdf');
    }


    /**
     * Cetak PDF Laporan Disposisi
     */
    public function disposisi(Request $request)
    {
        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');

        $query = Disposisi::with('suratMasuk');

        if ($tglMulai && $tglSelesai) {
            $query->whereBetween('tgl_disposisi', [
                $tglMulai,
                $tglSelesai
            ]);
        }

        $disposisi = $query
            ->orderBy('tgl_disposisi', 'asc')
            ->get();

        $pdf = Pdf::loadView('laporan.disposisi', [
            'disposisi' => $disposisi,
            'tglMulai' => $tglMulai,
            'tglSelesai' => $tglSelesai,
        ]);

        return $pdf->stream('laporan-disposisi.pdf');
    }


    /**
     * Export Excel Surat Masuk
     */
    public function exportExcelSuratMasuk(Request $request)
    {
        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');

        return Excel::download(
            new SuratMasukExport($tglMulai, $tglSelesai),
            'Laporan_Surat_Masuk_' . now()->format('Y-m-d') . '.xlsx'
        );
    }


    /**
     * Export Excel Disposisi
     */
    public function exportExcelDisposisi(Request $request)
    {
        $tglMulai = $request->query('tgl_mulai');
        $tglSelesai = $request->query('tgl_selesai');

        return Excel::download(
            new DisposisiExport($tglMulai, $tglSelesai),
            'Laporan_Disposisi_' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}
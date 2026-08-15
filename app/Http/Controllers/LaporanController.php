<?php

namespace App\Http\Controllers;

use App\Exports\SuratMasukExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    /**
     * Export Surat Masuk ke Excel
     */
    public function exportExcel()
    {
        return Excel::download(
            new SuratMasukExport,
            'Laporan_Surat_Masuk.xlsx'
        );
    }
}
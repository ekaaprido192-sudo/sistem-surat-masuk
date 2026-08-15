<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class SuratMasukExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    use Exportable;

    protected $tglMulai;
    protected $tglSelesai;

    public function __construct($tglMulai, $tglSelesai)
    {
        $this->tglMulai = $tglMulai;
        $this->tglSelesai = $tglSelesai;
    }

    public function query()
    {
        $query = SuratMasuk::query();

        if ($this->tglMulai && $this->tglSelesai) {
            $query->whereBetween('tanggal_surat', [$this->tglMulai, $this->tglSelesai]);
        }

        return $query->orderBy('tanggal_surat', 'asc');
    }

    public function headings(): array
    {
        $periodeMulai = $this->tglMulai ? Carbon::parse($this->tglMulai)->translatedFormat('d F Y') : 'Semua Data';
        $periodeSelesai = $this->tglSelesai ? Carbon::parse($this->tglSelesai)->translatedFormat('d F Y') : 'Semua Data';

        return [
            ['LAPORAN DATA SURAT MASUK'],
            ['BADAN KEUANGAN DAN ASET DAERAH KOTA BOGOR'],
            ['Periode : ' . $periodeMulai . ' s/d ' . $periodeSelesai],
            [''], // Baris Kosong sebagai pemisah
            [
                'No Agenda',
                'Nomor Surat',
                'Tanggal Surat',
                'Tanggal Diterima',
                'Asal Surat',
                'Perihal',
                'Tujuan',
                'Sifat',
                'Status'
            ]
        ];
    }

    public function map($row): array
    {
        return [
            $row->nomor_agenda,
            $row->nomor_surat,
            $row->tanggal_surat ? Carbon::parse($row->tanggal_surat)->format('d-m-Y') : '-',
            $row->tanggal_diterima ? Carbon::parse($row->tanggal_diterima)->format('d-m-Y') : '-',
            $row->asal_surat,
            $row->perihal,
            $row->tujuan, 
            $row->sifat,
            $row->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Menggabungkan (Merge) sel untuk Judul Laporan
        $sheet->mergeCells('A1:I1');
        $sheet->mergeCells('A2:I2');
        $sheet->mergeCells('A3:I3');

        return [
            // Styling Baris Judul
            1    => ['font' => ['bold' => true, 'size' => 14]],
            2    => ['font' => ['bold' => true, 'size' => 12]],
            3    => ['font' => ['italic' => true]],
            // Styling Header Tabel Data (Baris ke-5)
            5    => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'FFEEEEEE']
                ],
                'borders' => [
                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                ],
            ],
        ];
    }
}
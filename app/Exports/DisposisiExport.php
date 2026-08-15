<?php

namespace App\Exports;

use App\Models\Disposisi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class DisposisiExport implements FromQuery, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
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
        $query = Disposisi::with('suratMasuk');

        if ($this->tglMulai && $this->tglSelesai) {
            $query->whereBetween('tgl_disposisi', [$this->tglMulai, $this->tglSelesai]);
        }

        return $query->orderBy('tgl_disposisi', 'asc');
    }

    public function headings(): array
    {
        $periodeMulai = $this->tglMulai ? Carbon::parse($this->tglMulai)->translatedFormat('d F Y') : 'Semua Data';
        $periodeSelesai = $this->tglSelesai ? Carbon::parse($this->tglSelesai)->translatedFormat('d F Y') : 'Semua Data';

        return [
            ['LAPORAN DATA DISPOSISI'],
            ['BADAN KEUANGAN DAN ASET DAERAH KOTA BOGOR'],
            ['Periode : ' . $periodeMulai . ' s/d ' . $periodeSelesai],
            [''],
            [
                'Tanggal Disposisi',
                'Nomor Surat',
                'Perihal',
                'Tujuan Bidang',
                'Sifat',
                'Instruksi',
                'Status Surat'
            ]
        ];
    }

    public function map($row): array
    {
        return [
            $row->tgl_disposisi ? Carbon::parse($row->tgl_disposisi)->format('d-m-Y') : '-',
            $row->suratMasuk ? $row->suratMasuk->nomor_surat : '-',
            $row->suratMasuk ? $row->suratMasuk->perihal : '-',
            $row->tujuan_bidang,
            $row->sifat,
            $row->instruksi,
            $row->suratMasuk ? $row->suratMasuk->status : '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:G1');
        $sheet->mergeCells('A2:G2');
        $sheet->mergeCells('A3:G3');

        return [
            1    => ['font' => ['bold' => true, 'size' => 14]],
            2    => ['font' => ['bold' => true, 'size' => 12]],
            3    => ['font' => ['italic' => true]],
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
<?php

namespace App\Filament\Widgets;

use App\Models\SuratMasuk;
use Filament\Widgets\ChartWidget;

class SuratMasukChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Surat Masuk per Bulan';

    protected int | string | array $columnSpan = 'full';

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $data = [];

        for ($i = 1; $i <= 12; $i++) {
            $data[] = SuratMasuk::whereMonth('tanggal_diterima', $i)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Surat Masuk',
                    'data' => $data,
                    'borderColor' => '#d97706',
                    'backgroundColor' => 'rgba(217, 119, 6, 0.1)',
                    'fill' => 'start',
                    'tension' => 0.4,
                ],
            ],
            'labels' => [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Agu',
                'Sep',
                'Okt',
                'Nov',
                'Des',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
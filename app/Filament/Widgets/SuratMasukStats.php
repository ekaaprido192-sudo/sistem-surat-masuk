<?php

namespace App\Filament\Widgets;

use App\Models\SuratMasuk;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SuratMasukStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('📥 Total Surat Masuk', SuratMasuk::count())
                ->description('Seluruh surat yang diterima')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary')
                ->chart([3, 5, 8, 6, 10, 12, 15]),

            Stat::make('🆕 Surat Baru', SuratMasuk::where('status', 'Baru')->count())
                ->description('Menunggu disposisi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart([7, 5, 4, 3, 2, 2, 1]),

            Stat::make('📌 Sedang Diproses', SuratMasuk::where('status', 'Diproses')->count())
                ->description('Dalam proses bidang')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('info')
                ->chart([2, 3, 4, 5, 4, 3, 2]),

            Stat::make('✅ Surat Selesai', SuratMasuk::where('status', 'Selesai')->count())
                ->description('Disposisi selesai')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([1, 2, 3, 4, 5, 6, 7]),

        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
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
            Stat::make('Total Surat Masuk', SuratMasuk::count())
                ->description('Jumlah seluruh surat masuk')
                ->color('primary'),

            Stat::make('Surat Baru', SuratMasuk::where('status', 'Baru')->count())
                ->description('Belum diproses')
                ->color('warning'),

            Stat::make('Diproses', SuratMasuk::where('status', 'Diproses')->count())
                ->description('Sedang diproses')
                ->color('info'),

            Stat::make('Selesai', SuratMasuk::where('status', 'Selesai')->count())
                ->description('Sudah selesai')
                ->color('success'),
        ];
    }
}
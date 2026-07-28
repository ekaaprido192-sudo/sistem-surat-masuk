<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\SuratMasukStats;
use App\Filament\Widgets\SuratMasukChart;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getHeaderWidgets(): array
    {
        return [
            SuratMasukStats::class,
            SuratMasukChart::class,
        ];
    }
}
<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\WelcomeWidget;
use App\Filament\Widgets\SuratMasukChart;
use App\Filament\Widgets\SuratMasukStats;
use App\Livewire\SuratMasukTerbaru;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            WelcomeWidget::class,
            SuratMasukStats::class,
            SuratMasukChart::class,
            SuratMasukTerbaru::class,
        ];
    }

    public function getColumns(): array|int
    {
        return 1;
    }
}
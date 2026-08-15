<?php

namespace App\Filament\Resources\SuratMasuks\Pages;

use App\Filament\Resources\SuratMasuks\SuratMasukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuratMasuks extends ListRecords
{
    protected static string $resource = SuratMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [

            Actions\CreateAction::make()
                ->label('Tambah Surat Masuk')
                ->icon('heroicon-o-plus-circle')
                ->color('primary'),

            Actions\Action::make('pdf')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->color('danger')
                ->url(route('laporan.surat-masuk'))
                ->openUrlInNewTab(),

            Actions\Action::make('excel')
                ->label('Export Excel')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(route('laporan.surat-masuk.excel'))
                ->openUrlInNewTab(),

        ];
    }

    public function getTitle(): string
    {
        return 'Data Surat Masuk';
    }

    public function getSubheading(): ?string
    {
        return 'Sistem Pengolahan Data Surat Masuk BKAD Kota Bogor';
    }
}
<?php

namespace App\Livewire;

use App\Models\SuratMasuk;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class SuratMasukTerbaru extends BaseWidget
{
    protected static ?string $heading = '📥 Surat Masuk Terbaru';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                SuratMasuk::query()->latest()
            )

            ->defaultPaginationPageOption(5)

            ->columns([

                TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable(),

                TextColumn::make('asal_surat')
                    ->label('Asal Surat')
                    ->searchable(),

                TextColumn::make('perihal')
                    ->label('Perihal')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->perihal),

                BadgeColumn::make('status')
                    ->colors([
                        'info' => 'Baru',
                        'warning' => 'Diproses',
                        'success' => 'Selesai',
                    ]),

                TextColumn::make('tanggal_diterima')
                    ->label('Tanggal Diterima')
                    ->date('d-m-Y')
                    ->sortable(),

            ]);
    }
}
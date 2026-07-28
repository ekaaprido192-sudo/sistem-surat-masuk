<?php

namespace App\Filament\Resources\Disposisis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DisposisisTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->defaultSort('id', 'desc')

            ->columns([

                TextColumn::make('id')
                    ->label('No')
                    ->sortable(),

                TextColumn::make('suratMasuk.nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tujuan_bidang')
                    ->label('Tujuan Bidang')
                    ->searchable(),

                TextColumn::make('instruksi')
                    ->label('Instruksi')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->instruksi),

                TextColumn::make('sifat')
                    ->label('Sifat')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Biasa' => 'gray',
                        'Penting' => 'warning',
                        'Rahasia' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('tgl_disposisi')
                    ->label('Tanggal Disposisi')
                    ->date('d-m-Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d-m-Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->filters([

            ])

            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])

            ->emptyStateHeading('Belum ada data disposisi')

            ->emptyStateDescription('Silakan tambahkan disposisi surat terlebih dahulu.');
    }
}
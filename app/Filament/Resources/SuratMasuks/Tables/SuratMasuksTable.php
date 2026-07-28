<?php

namespace App\Filament\Resources\SuratMasuks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuratMasuksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')

            ->columns([

                TextColumn::make('id')
                    ->label('No')
                    ->sortable(),

                TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tanggal_surat')
                    ->label('Tanggal Surat')
                    ->date('d-m-Y')
                    ->sortable(),

                TextColumn::make('tanggal_diterima')
                    ->label('Tanggal Diterima')
                    ->date('d-m-Y')
                    ->sortable(),

                TextColumn::make('asal_surat')
                    ->label('Asal Surat')
                    ->searchable(),

                TextColumn::make('perihal')
                    ->label('Perihal')
                    ->limit(40)
                    ->searchable(),

                TextColumn::make('tujuan')
                    ->label('Tujuan')
                    ->toggleable(),

                TextColumn::make('sifat')
                    ->label('Sifat')
                    ->badge()
                    ->icon('heroicon-m-document-text')
                    ->color(fn (string $state): string => match ($state) {
                        'Biasa' => 'gray',
                        'Penting' => 'warning',
                        'Rahasia' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('file_surat')
                    ->label('File Surat')
                    ->formatStateUsing(fn ($state) => $state ? '📄 Lihat PDF' : '-')
                    ->url(fn ($record) => $record->file_surat
                        ? asset('storage/' . $record->file_surat)
                        : null)
                    ->openUrlInNewTab()
                    ->color('primary'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->icon('heroicon-m-check-badge')
                    ->color(fn (string $state): string => match ($state) {
                        'Baru' => 'info',
                        'Diproses' => 'warning',
                        'Selesai' => 'success',
                        default => 'gray',
                    }),

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

            ->emptyStateHeading('Belum ada data Surat Masuk')

            ->emptyStateDescription('Silakan tambahkan data Surat Masuk terlebih dahulu.');
    }
}
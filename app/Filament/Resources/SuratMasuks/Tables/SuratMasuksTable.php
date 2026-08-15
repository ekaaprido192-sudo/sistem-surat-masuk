<?php

namespace App\Filament\Resources\SuratMasuks\Tables;

use App\Filament\Resources\Disposisis\DisposisiResource;
use App\Models\SuratMasuk;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SuratMasuksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('nomor_agenda')
                    ->label('No. Agenda')
                    ->badge()
                    ->color('success')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->weight('bold')
                    ->copyable()
                    ->copyMessage('Nomor surat disalin!')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tanggal_surat')
                    ->label('Tgl Surat')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('tanggal_diterima')
                    ->label('Tgl Terima')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('asal_surat')
                    ->label('Asal Surat')
                    ->wrap()
                    ->searchable(),

                TextColumn::make('perihal')
                    ->label('Perihal')
                    ->limit(35)
                    ->tooltip(fn ($record) => $record->perihal)
                    ->searchable(),

                TextColumn::make('tujuan')
                    ->label('Tujuan')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                TextColumn::make('sifat')
                    ->label('Sifat')
                    ->badge()
                    ->icon('heroicon-o-document-text')
                    ->color(fn(string $state): string => match ($state) {
                        'Biasa' => 'gray',
                        'Penting' => 'warning',
                        'Rahasia' => 'danger',
                        'Segera' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('file_surat')
                    ->label('Berkas')
                    ->badge()
                    ->color(fn ($state) => $state ? 'primary' : 'gray')
                    ->formatStateUsing(function ($state) {
                        if (!$state) return 'Tidak Ada';
                        $ext = pathinfo($state, PATHINFO_EXTENSION);
                        return in_array(strtolower($ext), ['jpg', 'jpeg', 'png']) ? '🖼️ Gambar' : '📄 Dokumen';
                    })
                    ->url(fn ($record) => $record->file_surat
                        ? asset('storage/' . $record->file_surat)
                        : null)
                    ->openUrlInNewTab(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->sortable()
                    ->icon('heroicon-o-check-badge')
                    ->color(fn(string $state): string => match ($state) {
                        'Baru' => 'info',
                        'Diproses' => 'warning',
                        'Selesai' => 'success',
                        default => 'gray',
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Surat')
                    ->options([
                        'Baru' => 'Baru',
                        'Diproses' => 'Diproses',
                        'Selesai' => 'Selesai',
                    ]),

                SelectFilter::make('sifat')
                    ->label('Sifat Surat')
                    ->options([
                        'Biasa' => 'Biasa',
                        'Penting' => 'Penting',
                        'Rahasia' => 'Rahasia',
                        'Segera' => 'Segera',
                    ]),

                SelectFilter::make('asal_surat')
                    ->label('Asal Surat')
                    ->options(
                        fn () => SuratMasuk::query()
                            ->orderBy('asal_surat')
                            ->distinct()
                            ->pluck('asal_surat', 'asal_surat')
                            ->toArray()
                    ),

                Filter::make('tanggal_diterima')
                    ->label('Rentang Tanggal Terima')
                    ->form([
                        DatePicker::make('dari')->label('Dari Tanggal'),
                        DatePicker::make('sampai')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari'] ?? null,
                                fn (Builder $query, $date) => $query->whereDate('tanggal_diterima', '>=', $date)
                            )
                            ->when(
                                $data['sampai'] ?? null,
                                fn (Builder $query, $date) => $query->whereDate('tanggal_diterima', '<=', $date)
                            );
                    }),
            ])
            ->recordActions([
                // Tombol aksi cepat disposisi jika surat masih baru
                Action::make('buat_disposisi')
                    ->label('Disposisi')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('warning')
                    ->visible(fn ($record) => $record->status === 'Baru')
                    ->url(fn ($record) => DisposisiResource::getUrl('create', [
                        'surat_masuk_id' => $record->id,
                    ])),

                // Tombol aksi tandai selesai
                Action::make('selesai')
                    ->label('Selesai')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => $record->status === 'Diproses')
                    ->requiresConfirmation()
                    ->modalHeading('Selesaikan Penanganan Surat')
                    ->modalDescription('Apakah surat ini telah selesai ditindaklanjuti?')
                    ->modalSubmitActionLabel('Ya, Selesaikan')
                    ->action(function ($record) {
                        $record->update(['status' => 'Selesai']);

                        Notification::make()
                            ->title('Status Diperbarui')
                            ->body("Surat {$record->nomor_surat} ditandai sebagai Selesai.")
                            ->success()
                            ->send();
                    }),

                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada data Surat Masuk')
            ->emptyStateDescription('Silakan klik tombol tambah surat masuk di atas untuk memulai pendataan.');
    }
}
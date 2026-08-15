<?php

namespace App\Filament\Resources\Disposisis\Tables;

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

class DisposisisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('id', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('suratMasuk.nomor_agenda')
                    ->label('No. Agenda')
                    ->badge()
                    ->color('success')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('suratMasuk.nomor_surat')
                    ->label('Nomor Surat')
                    ->weight('bold')
                    ->copyable()
                    ->copyMessage('Nomor surat disalin!')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('suratMasuk.asal_surat')
                    ->label('Asal Surat')
                    ->wrap()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('suratMasuk.perihal')
                    ->label('Perihal')
                    ->limit(35)
                    ->tooltip(fn ($record) => $record->suratMasuk?->perihal)
                    ->searchable(),

                TextColumn::make('tujuan_bidang')
                    ->label('Tujuan Bidang')
                    ->badge()
                    ->color('primary')
                    ->searchable(),

                TextColumn::make('instruksi')
                    ->label('Instruksi')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->instruksi),

                TextColumn::make('sifat')
                    ->label('Sifat')
                    ->badge()
                    ->icon('heroicon-o-document-text')
                    ->color(fn (string $state): string => match ($state) {
                        'Biasa' => 'gray',
                        'Penting' => 'warning',
                        'Rahasia' => 'danger',
                        'Segera' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('suratMasuk.status')
                    ->label('Status Surat')
                    ->badge()
                    ->sortable()
                    ->icon('heroicon-o-check-badge')
                    ->color(fn (string $state): string => match ($state) {
                        'Baru' => 'info',
                        'Diproses' => 'warning',
                        'Selesai' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('tgl_disposisi')
                    ->label('Tgl Disposisi')
                    ->date('d/m/Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tujuan_bidang')
                    ->label('Tujuan Bidang')
                    ->options([
                        'Kepala BKAD' => 'Kepala BKAD',
                        'Sekretariat' => 'Sekretariat',
                        'Bidang Anggaran' => 'Bidang Anggaran',
                        'Bidang Perbendaharaan' => 'Bidang Perbendaharaan',
                        'Bidang Akuntansi' => 'Bidang Akuntansi',
                        'Bidang Aset Daerah' => 'Bidang Aset Daerah',
                    ]),

                SelectFilter::make('sifat')
                    ->label('Sifat Disposisi')
                    ->options([
                        'Biasa' => 'Biasa',
                        'Penting' => 'Penting',
                        'Rahasia' => 'Rahasia',
                        'Segera' => 'Segera',
                    ]),

                SelectFilter::make('status')
                    ->label('Status Surat')
                    ->relationship('suratMasuk', 'status'),

                Filter::make('tgl_disposisi')
                    ->label('Rentang Tanggal Disposisi')
                    ->form([
                        DatePicker::make('dari')->label('Dari Tanggal'),
                        DatePicker::make('sampai')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari'] ?? null,
                                fn (Builder $query, $date) => $query->whereDate('tgl_disposisi', '>=', $date)
                            )
                            ->when(
                                $data['sampai'] ?? null,
                                fn (Builder $query, $date) => $query->whereDate('tgl_disposisi', '<=', $date)
                            );
                    }),
            ])
            ->recordActions([
                Action::make('cetakLembarDisposisi')
                    ->label('Cetak Lembar')
                    ->icon('heroicon-o-printer')
                    ->color('info')
                    ->url(fn ($record) => route('disposisi.cetak', $record->id))
                    ->openUrlInNewTab(),

                EditAction::make(),
                DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Data Disposisi Dihapus')
                            ->body('Data berhasil dihapus dari sistem.')
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada data disposisi')
            ->emptyStateDescription('Silakan tambahkan data disposisi surat masuk terlebih dahulu.');
    }
}
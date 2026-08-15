<?php

namespace App\Filament\Resources\Disposisis\Schemas;

use App\Models\SuratMasuk;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DisposisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                Select::make('surat_masuk_id')
                    ->label('Pilih Surat Masuk')
                    ->relationship(
                        name: 'suratMasuk',
                        titleAttribute: 'nomor_surat',
                        modifyQueryUsing: fn ($query, $record) => $query
                            ->where('status', 'Baru')
                            ->orWhere('id', $record?->surat_masuk_id)
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn (SuratMasuk $record) =>
                        "{$record->nomor_agenda} | {$record->nomor_surat} - {$record->asal_surat} ({$record->perihal})"
                    )
                    ->searchable(['nomor_agenda', 'nomor_surat', 'asal_surat', 'perihal'])
                    ->preload()
                    ->native(false)
                    ->required()
                    ->columnSpanFull(),

                Select::make('tujuan_bidang')
                    ->label('Tujuan Bidang / Pejabat')
                    ->options([
                        'Kepala BKAD' => 'Kepala BKAD',
                        'Sekretariat' => 'Sekretariat',
                        'Bidang Anggaran' => 'Bidang Anggaran',
                        'Bidang Perbendaharaan' => 'Bidang Perbendaharaan',
                        'Bidang Akuntansi' => 'Bidang Akuntansi',
                        'Bidang Aset Daerah' => 'Bidang Aset Daerah',
                    ])
                    ->searchable()
                    ->native(false)
                    ->required(),

                Select::make('sifat')
                    ->label('Sifat Disposisi')
                    ->options([
                        'Biasa' => 'Biasa',
                        'Penting' => 'Penting',
                        'Rahasia' => 'Rahasia',
                        'Segera' => 'Segera',
                    ])
                    ->default('Biasa')
                    ->native(false)
                    ->required(),

                DatePicker::make('tgl_disposisi')
                    ->label('Tanggal Disposisi')
                    ->displayFormat('d/m/Y')
                    ->default(now())
                    ->native(false)
                    ->required()
                    ->columnSpanFull(),

                Textarea::make('instruksi')
                    ->label('Instruksi / Catatan Pimpinan')
                    ->rows(4)
                    ->placeholder('Contoh: Mohon dipelajari dan segera ditindaklanjuti sesuai ketentuan yang berlaku.')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
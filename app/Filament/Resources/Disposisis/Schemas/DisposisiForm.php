<?php

namespace App\Filament\Resources\Disposisis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class DisposisiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('surat_masuk_id')
                    ->relationship('suratMasuk', 'nomor_surat')
                    ->label('Nomor Surat Masuk')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('tujuan_bidang')
                    ->label('Tujuan Bidang')
                    ->options([
                        'Kepala BKAD' => 'Kepala BKAD',
                        'Sekretariat' => 'Sekretariat',
                        'Bidang Anggaran' => 'Bidang Anggaran',
                        'Bidang Perbendaharaan' => 'Bidang Perbendaharaan',
                        'Bidang Aset Daerah' => 'Bidang Aset Daerah',
                        'Bidang Akuntansi' => 'Bidang Akuntansi',
                    ])
                    ->required(),

                Textarea::make('instruksi')
                    ->label('Instruksi')
                    ->required(),

                Select::make('sifat')
                    ->options([
                        'Biasa' => 'Biasa',
                        'Penting' => 'Penting',
                        'Rahasia' => 'Rahasia',
                    ])
                    ->required(),

                DatePicker::make('tgl_disposisi')
                    ->label('Tanggal Disposisi')
                    ->required(),

            ]);
    }
}
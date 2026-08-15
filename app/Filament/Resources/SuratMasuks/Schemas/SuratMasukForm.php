<?php

namespace App\Filament\Resources\SuratMasuks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SuratMasukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([

                TextInput::make('nomor_agenda')
                    ->label('Nomor Agenda')
                    ->disabled()
                    ->dehydrated(false)
                    ->placeholder('Otomatis dibuat oleh sistem (misal: AGD-0001)'),

                TextInput::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder('Contoh: 800/001/BKAD/VIII/2026')
                    ->maxLength(255),

                Select::make('sifat')
                    ->label('Sifat Surat')
                    ->options([
                        'Biasa' => 'Biasa',
                        'Penting' => 'Penting',
                        'Rahasia' => 'Rahasia',
                        'Segera' => 'Segera',
                    ])
                    ->default('Biasa')
                    ->native(false)
                    ->required(),

                Select::make('status')
                    ->label('Status Surat')
                    ->options([
                        'Baru' => 'Baru',
                        'Diproses' => 'Diproses',
                        'Selesai' => 'Selesai',
                    ])
                    ->default('Baru')
                    ->native(false)
                    ->required(),

                DatePicker::make('tanggal_surat')
                    ->label('Tanggal Surat')
                    ->displayFormat('d/m/Y')
                    ->default(now())
                    ->native(false)
                    ->required(),

                DatePicker::make('tanggal_diterima')
                    ->label('Tanggal Diterima')
                    ->displayFormat('d/m/Y')
                    ->default(now())
                    ->native(false)
                    ->required(),

                TextInput::make('asal_surat')
                    ->label('Asal / Pengirim Surat')
                    ->placeholder('Contoh: Dinas Pendidikan Kota Bogor')
                    ->required()
                    ->maxLength(255),

                Select::make('tujuan')
                    ->label('Tujuan / Ditujukan Kepada')
                    ->options([
                        'Kepala BKAD Kota Bogor' => 'Kepala BKAD Kota Bogor',
                        'Sekretariat BKAD' => 'Sekretariat BKAD',
                        'Bidang Anggaran' => 'Bidang Anggaran',
                        'Bidang Perbendaharaan' => 'Bidang Perbendaharaan',
                        'Bidang Akuntansi' => 'Bidang Akuntansi',
                        'Bidang Aset Daerah' => 'Bidang Aset Daerah',
                    ])
                    ->searchable()
                    ->native(false)
                    ->required(),

                Textarea::make('perihal')
                    ->label('Perihal / Ringkasan Surat')
                    ->placeholder('Tuliskan perihal atau isi ringkas surat...')
                    ->rows(3)
                    ->required()
                    ->columnSpanFull(),

                FileUpload::make('file_surat')
                    ->label('Upload Berkas Surat')
                    ->disk('public')
                    ->directory('surat-masuk')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'image/jpeg',
                        'image/png',
                    ])
                    ->maxSize(5120)
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->helperText('Format yang didukung: PDF, JPG, PNG (Maksimal 5 MB).')
                    ->columnSpanFull(),
            ]);
    }
}
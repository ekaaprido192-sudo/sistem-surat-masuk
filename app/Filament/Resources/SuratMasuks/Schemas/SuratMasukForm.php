<?php

namespace App\Filament\Resources\SuratMasuks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SuratMasukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('nomor_surat')
                    ->label('Nomor Surat')
                    ->placeholder('Masukkan nomor surat')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                DatePicker::make('tanggal_surat')
                    ->label('Tanggal Surat')
                    ->required(),

                DatePicker::make('tanggal_diterima')
                    ->label('Tanggal Diterima')
                    ->required(),

                TextInput::make('asal_surat')
                    ->label('Asal Surat')
                    ->placeholder('Contoh: Pemerintah Kota Bogor')
                    ->required()
                    ->maxLength(255),

                TextInput::make('perihal')
                    ->label('Perihal')
                    ->placeholder('Masukkan perihal surat')
                    ->required()
                    ->maxLength(255),

                TextInput::make('tujuan')
                    ->label('Tujuan')
                    ->placeholder('Masukkan tujuan surat')
                    ->required()
                    ->maxLength(255),

                Select::make('sifat')
                    ->label('Sifat Surat')
                    ->options([
                        'Biasa' => 'Biasa',
                        'Penting' => 'Penting',
                        'Rahasia' => 'Rahasia',
                    ])
                    ->searchable()
                    ->native(false)
                    ->required(),

                FileUpload::make('file_surat')
                    ->label('Upload File Surat')
                    ->disk('public')
                    ->directory('surat-masuk')
                    ->acceptedFileTypes([
                        'application/pdf',
                    ])
                    ->maxSize(5120)
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable()
                    ->previewable(false)
                    ->helperText('Upload file PDF maksimal 5 MB.')
                    ->columnSpanFull(),

                Select::make('status')
                    ->label('Status Surat')
                    ->options([
                        'Baru' => 'Baru',
                        'Diproses' => 'Diproses',
                        'Selesai' => 'Selesai',
                    ])
                    ->default('Baru')
                    ->searchable()
                    ->native(false)
                    ->required(),

            ]);
    }
}
<?php

namespace App\Filament\Pages;

use BackedEnum;
use UnitEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;

class LaporanSurat extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.laporan-surat';

    protected static ?string $navigationLabel = 'Laporan Cetak & Export';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string|UnitEnum|null $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 1;

    public ?array $suratMasukData = [];

    public ?array $disposisiData = [];

    public function mount(): void
    {
        $this->suratMasukData = [
            'tgl_mulai' => now()->startOfMonth(),
            'tgl_selesai' => now(),
        ];

        $this->disposisiData = [
            'tgl_mulai' => now()->startOfMonth(),
            'tgl_selesai' => now(),
        ];
    }

    public function suratMasukForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('suratMasukData')
            ->components([
                Section::make('Laporan Surat Masuk')
                    ->schema([
                        DatePicker::make('tgl_mulai')
                            ->label('Tanggal Mulai')
                            ->required(),

                        DatePicker::make('tgl_selesai')
                            ->label('Tanggal Selesai')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public function disposisiForm(Schema $schema): Schema
    {
        return $schema
            ->statePath('disposisiData')
            ->components([
                Section::make('Laporan Disposisi')
                    ->schema([
                        DatePicker::make('tgl_mulai')
                            ->label('Tanggal Mulai')
                            ->required(),

                        DatePicker::make('tgl_selesai')
                            ->label('Tanggal Selesai')
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public function cetakSuratMasuk()
    {
        return redirect()->route('laporan.surat-masuk', $this->suratMasukData);
    }

    public function exportExcelSuratMasuk()
    {
        return redirect()->route('laporan.surat-masuk.excel', $this->suratMasukData);
    }

    public function cetakDisposisi()
    {
        return redirect()->route('laporan.disposisi', $this->disposisiData);
    }

    public function exportExcelDisposisi()
    {
        return redirect()->route('laporan.disposisi.excel', $this->disposisiData);
    }
}
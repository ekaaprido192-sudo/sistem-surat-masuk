<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LaporanSurat extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.laporan-surat';

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Laporan';
    }

    public function getTitle(): string
    {
        return 'Laporan Surat & Disposisi';
    }

    public ?array $suratMasukData = [];
    public ?array $disposisiData = [];

    public function mount(): void
    {
        $this->suratMasukForm->fill();
        $this->disposisiForm->fill();
    }

    protected function getForms(): array
    {
        return [
            'suratMasukForm',
            'disposisiForm',
        ];
    }

    // Form 1: Surat Masuk
    public function suratMasukForm(Form|Schema $form): Form|Schema
    {
        return $form
            ->schema([
                Section::make('Laporan Surat Masuk')
                    ->description('Filter dan cetak laporan surat masuk berdasarkan rentang tanggal')
                    ->schema([
                        DatePicker::make('tgl_mulai')
                            ->label('Tanggal Mulai')
                            ->required(),
                        DatePicker::make('tgl_selesai')
                            ->label('Tanggal Selesai')
                            ->required(),
                    ])
                    ->columns(2),
            ])
            ->statePath('suratMasukData');
    }

    // Form 2: Disposisi
    public function disposisiForm(Form|Schema $form): Form|Schema
    {
        return $form
            ->schema([
                Section::make('Laporan Disposisi')
                    ->description('Filter dan cetak laporan disposisi berdasarkan rentang tanggal')
                    ->schema([
                        DatePicker::make('tgl_mulai')
                            ->label('Tanggal Mulai')
                            ->required(),
                        DatePicker::make('tgl_selesai')
                            ->label('Tanggal Selesai')
                            ->required(),
                    ])
                    ->columns(2),
            ])
            ->statePath('disposisiData');
    }

    public function cetakSuratMasuk()
    {
        $data = $this->suratMasukForm->getState();

        return redirect()->route('laporan.surat-masuk', [
            'tgl_mulai' => $data['tgl_mulai'] ?? null,
            'tgl_selesai' => $data['tgl_selesai'] ?? null,
        ]);
    }

    public function exportExcelSuratMasuk()
    {
        $data = $this->suratMasukForm->getState();

        return redirect()->route('laporan.surat-masuk.excel', [
            'tgl_mulai' => $data['tgl_mulai'] ?? null,
            'tgl_selesai' => $data['tgl_selesai'] ?? null,
        ]);
    }

    public function cetakDisposisi()
    {
        $data = $this->disposisiForm->getState();

        return redirect()->route('laporan.disposisi', [
            'tgl_mulai' => $data['tgl_mulai'] ?? null,
            'tgl_selesai' => $data['tgl_selesai'] ?? null,
        ]);
    }

    public function exportExcelDisposisi()
    {
        $data = $this->disposisiForm->getState();

        return redirect()->route('laporan.disposisi.excel', [
            'tgl_mulai' => $data['tgl_mulai'] ?? null,
            'tgl_selesai' => $data['tgl_selesai'] ?? null,
        ]);
    }
}
<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class Laporan extends Page implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.pages.laporan';

    public static function getNavigationLabel(): string
    {
        return 'Laporan';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Laporan';
    }

    public static function getNavigationSort(): ?int
    {
        return 10;
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

    public function suratMasukForm($form)
    {
        return $form
            ->schema([
                Section::make('📄 Laporan Surat Masuk')
                    ->description('Cetak data surat masuk berdasarkan rentang tanggal.')
                    ->schema([
                        DatePicker::make('tgl_mulai')
                            ->label('Dari Tanggal')
                            ->required()
                            ->native(false),
                        DatePicker::make('tgl_selesai')
                            ->label('Sampai Tanggal')
                            ->required()
                            ->native(false),
                    ])->columns(2),
            ])
            ->statePath('suratMasukData');
    }

    public function disposisiForm($form)
    {
        return $form
            ->schema([
                Section::make('📋 Laporan Disposisi')
                    ->description('Cetak data disposisi surat berdasarkan rentang tanggal.')
                    ->schema([
                        DatePicker::make('tgl_mulai')
                            ->label('Dari Tanggal')
                            ->required()
                            ->native(false),
                        DatePicker::make('tgl_selesai')
                            ->label('Sampai Tanggal')
                            ->required()
                            ->native(false),
                    ])->columns(2),
            ])
            ->statePath('disposisiData');
    }

    public function cetakSuratMasuk()
    {
        $data = $this->suratMasukForm->getState();

        $url = route('laporan.surat-masuk', [
            'tgl_mulai' => $data['tgl_mulai'],
            'tgl_selesai' => $data['tgl_selesai'],
        ]);

        return redirect()->away($url);
    }

    public function cetakDisposisi()
    {
        $data = $this->disposisiForm->getState();

        $url = route('laporan.disposisi', [
            'tgl_mulai' => $data['tgl_mulai'],
            'tgl_selesai' => $data['tgl_selesai'],
        ]);

        return redirect()->away($url);
    }
}
<?php

namespace App\Filament\Resources\Disposisis\Pages;

use App\Filament\Resources\Disposisis\DisposisiResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateDisposisi extends CreateRecord
{
    protected static string $resource = DisposisiResource::class;

    protected function afterCreate(): void
    {
        if ($this->record->suratMasuk) {
            $this->record->suratMasuk->update([
                'status' => 'Diproses',
            ]);
        }

        Notification::make()
            ->title('Disposisi berhasil dibuat')
            ->body('Status surat otomatis berubah menjadi Diproses.')
            ->success()
            ->send();
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
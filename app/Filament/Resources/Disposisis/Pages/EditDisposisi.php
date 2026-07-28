<?php

namespace App\Filament\Resources\Disposisis\Pages;

use App\Filament\Resources\Disposisis\DisposisiResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDisposisi extends EditRecord
{
    protected static string $resource = DisposisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->after(function () {
                    $surat = $this->record->suratMasuk;

                    if ($surat && $surat->disposisis()->count() === 0) {
                        $surat->update([
                            'status' => 'Baru',
                        ]);
                    }
                }),
        ];
    }
}
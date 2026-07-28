<?php

namespace App\Filament\Resources\Disposisis\Pages;

use App\Filament\Resources\Disposisis\DisposisiResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDisposisis extends ListRecords
{
    protected static string $resource = DisposisiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

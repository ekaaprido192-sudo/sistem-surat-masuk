<?php

namespace App\Filament\Resources\Disposisis;

use App\Filament\Resources\Disposisis\Pages\CreateDisposisi;
use App\Filament\Resources\Disposisis\Pages\EditDisposisi;
use App\Filament\Resources\Disposisis\Pages\ListDisposisis;
use App\Filament\Resources\Disposisis\Schemas\DisposisiForm;
use App\Filament\Resources\Disposisis\Tables\DisposisisTable;
use App\Models\Disposisi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DisposisiResource extends Resource
{
    protected static ?string $model = Disposisi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'tujuan_bidang';

    public static function form(Schema $schema): Schema
    {
        return DisposisiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DisposisisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDisposisis::route('/'),
            'create' => CreateDisposisi::route('/create'),
            'edit' => EditDisposisi::route('/{record}/edit'),
        ];
    }
}

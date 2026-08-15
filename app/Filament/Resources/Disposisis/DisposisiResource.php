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
use Filament\Tables\Table;
use UnitEnum;

class DisposisiResource extends Resource
{
    protected static ?string $model = Disposisi::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-paper-airplane';

    protected static string|UnitEnum|null $navigationGroup = 'Persuratan';

    protected static ?string $navigationLabel = 'Disposisi';

    protected static ?string $modelLabel = 'Disposisi';

    protected static ?string $pluralModelLabel = 'Disposisi';

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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDisposisis::route('/'),
            'create' => CreateDisposisi::route('/create'),
            'edit' => EditDisposisi::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        if (! auth()->check()) {
            return false;
        }

        return in_array(auth()->user()->role, [
            'Admin',
            'Staf',
        ]);
    }
}
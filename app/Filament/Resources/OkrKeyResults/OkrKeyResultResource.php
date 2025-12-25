<?php

namespace App\Filament\Resources\OkrKeyResults;

use App\Filament\Resources\OkrKeyResults\Pages\CreateOkrKeyResult;
use App\Filament\Resources\OkrKeyResults\Pages\EditOkrKeyResult;
use App\Filament\Resources\OkrKeyResults\Pages\ListOkrKeyResults;
use App\Filament\Resources\OkrKeyResults\Pages\ViewOkrKeyResult;
use App\Filament\Resources\OkrKeyResults\RelationManagers\CheckinsRelationManager;
use App\Filament\Resources\OkrKeyResults\Schemas\OkrKeyResultForm;
use App\Filament\Resources\OkrKeyResults\Schemas\OkrKeyResultInfolist;
use App\Filament\Resources\OkrKeyResults\Tables\OkrKeyResultsTable;
use App\Models\OkrKeyResult;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class OkrKeyResultResource extends Resource
{
    protected static ?string $model = OkrKeyResult::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Strategy';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return OkrKeyResultForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OkrKeyResultInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OkrKeyResultsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            CheckinsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOkrKeyResults::route('/'),
            'create' => CreateOkrKeyResult::route('/create'),
            'view' => ViewOkrKeyResult::route('/{record}'),
            'edit' => EditOkrKeyResult::route('/{record}/edit'),
        ];
    }
}

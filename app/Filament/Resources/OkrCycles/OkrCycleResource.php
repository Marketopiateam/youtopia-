<?php

namespace App\Filament\Resources\OkrCycles;

use App\Filament\Resources\OkrCycles\Pages\CreateOkrCycle;
use App\Filament\Resources\OkrCycles\Pages\EditOkrCycle;
use App\Filament\Resources\OkrCycles\Pages\ListOkrCycles;
use App\Filament\Resources\OkrCycles\Pages\ViewOkrCycle;
use App\Filament\Resources\OkrCycles\RelationManagers\ObjectivesRelationManager;
use App\Filament\Resources\OkrCycles\Schemas\OkrCycleForm;
use App\Filament\Resources\OkrCycles\Schemas\OkrCycleInfolist;
use App\Filament\Resources\OkrCycles\Tables\OkrCyclesTable;
use App\Models\OkrCycle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class OkrCycleResource extends Resource
{
    protected static ?string $model = OkrCycle::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Strategy';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return OkrCycleForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OkrCycleInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OkrCyclesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ObjectivesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOkrCycles::route('/'),
            'create' => CreateOkrCycle::route('/create'),
            'view' => ViewOkrCycle::route('/{record}'),
            'edit' => EditOkrCycle::route('/{record}/edit'),
        ];
    }
}

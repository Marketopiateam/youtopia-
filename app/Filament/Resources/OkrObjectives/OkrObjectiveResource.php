<?php

namespace App\Filament\Resources\OkrObjectives;

use App\Filament\Resources\OkrObjectives\Pages\CreateOkrObjective;
use App\Filament\Resources\OkrObjectives\Pages\EditOkrObjective;
use App\Filament\Resources\OkrObjectives\Pages\ListOkrObjectives;
use App\Filament\Resources\OkrObjectives\Pages\ViewOkrObjective;
use App\Filament\Resources\OkrObjectives\Schemas\OkrObjectiveForm;
use App\Filament\Resources\OkrObjectives\Schemas\OkrObjectiveInfolist;
use App\Filament\Resources\OkrObjectives\Tables\OkrObjectivesTable;
use App\Models\OkrObjective;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OkrObjectiveResource extends Resource
{
    protected static ?string $model = OkrObjective::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return OkrObjectiveForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OkrObjectiveInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OkrObjectivesTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOkrObjectives::route('/'),
            'create' => CreateOkrObjective::route('/create'),
            'view' => ViewOkrObjective::route('/{record}'),
            'edit' => EditOkrObjective::route('/{record}/edit'),
        ];
    }
}

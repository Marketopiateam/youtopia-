<?php

namespace App\Filament\Resources\WorklifeGroups;

use App\Filament\Resources\WorklifeGroups\Pages\CreateWorklifeGroup;
use App\Filament\Resources\WorklifeGroups\Pages\EditWorklifeGroup;
use App\Filament\Resources\WorklifeGroups\Pages\ListWorklifeGroups;
use App\Filament\Resources\WorklifeGroups\Pages\ViewWorklifeGroup;
use App\Filament\Resources\WorklifeGroups\RelationManagers\EmployeesRelationManager;
use App\Filament\Resources\WorklifeGroups\Schemas\WorklifeGroupForm;
use App\Filament\Resources\WorklifeGroups\Schemas\WorklifeGroupInfolist;
use App\Filament\Resources\WorklifeGroups\Tables\WorklifeGroupsTable;
use App\Models\WorklifeGroup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;


class WorklifeGroupResource extends Resource
{
    protected static ?string $model = WorklifeGroup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Social';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return WorklifeGroupForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WorklifeGroupInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorklifeGroupsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            EmployeesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorklifeGroups::route('/'),
            'create' => CreateWorklifeGroup::route('/create'),
            'view' => ViewWorklifeGroup::route('/{record}'),
            'edit' => EditWorklifeGroup::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

<?php

namespace App\Filament\Resources\DepartmentGoals;

use App\Filament\Resources\DepartmentGoals\Pages\CreateDepartmentGoal;
use App\Filament\Resources\DepartmentGoals\Pages\EditDepartmentGoal;
use App\Filament\Resources\DepartmentGoals\Pages\ListDepartmentGoals;
use App\Filament\Resources\DepartmentGoals\Pages\ViewDepartmentGoal;
use App\Filament\Resources\DepartmentGoals\RelationManagers\GoalLinksRelationManager;
use App\Filament\Resources\DepartmentGoals\Schemas\DepartmentGoalForm;
use App\Filament\Resources\DepartmentGoals\Schemas\DepartmentGoalInfolist;
use App\Filament\Resources\DepartmentGoals\Tables\DepartmentGoalsTable;
use App\Models\DepartmentGoal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DepartmentGoalResource extends Resource
{
    protected static ?string $model = DepartmentGoal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Strategy';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return DepartmentGoalForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DepartmentGoalInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DepartmentGoalsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            GoalLinksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDepartmentGoals::route('/'),
            'create' => CreateDepartmentGoal::route('/create'),
            'view' => ViewDepartmentGoal::route('/{record}'),
            'edit' => EditDepartmentGoal::route('/{record}/edit'),
        ];
    }
}

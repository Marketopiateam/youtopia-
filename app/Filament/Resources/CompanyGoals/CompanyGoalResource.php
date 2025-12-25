<?php

namespace App\Filament\Resources\CompanyGoals;

use App\Filament\Resources\CompanyGoals\Pages\CreateCompanyGoal;
use App\Filament\Resources\CompanyGoals\Pages\EditCompanyGoal;
use App\Filament\Resources\CompanyGoals\Pages\ListCompanyGoals;
use App\Filament\Resources\CompanyGoals\Pages\ViewCompanyGoal;
use App\Filament\Resources\CompanyGoals\RelationManagers\GoalLinksRelationManager;
use App\Filament\Resources\CompanyGoals\Schemas\CompanyGoalForm;
use App\Filament\Resources\CompanyGoals\Schemas\CompanyGoalInfolist;
use App\Filament\Resources\CompanyGoals\Tables\CompanyGoalsTable;
use App\Models\CompanyGoal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class CompanyGoalResource extends Resource
{
    protected static ?string $model = CompanyGoal::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Strategy';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CompanyGoalForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CompanyGoalInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanyGoalsTable::configure($table);
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
            'index' => ListCompanyGoals::route('/'),
            'create' => CreateCompanyGoal::route('/create'),
            'view' => ViewCompanyGoal::route('/{record}'),
            'edit' => EditCompanyGoal::route('/{record}/edit'),
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

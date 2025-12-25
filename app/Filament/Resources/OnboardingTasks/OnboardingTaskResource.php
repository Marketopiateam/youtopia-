<?php

namespace App\Filament\Resources\OnboardingTasks;

use App\Filament\Resources\OnboardingTasks\Pages\CreateOnboardingTask;
use App\Filament\Resources\OnboardingTasks\Pages\EditOnboardingTask;
use App\Filament\Resources\OnboardingTasks\Pages\ListOnboardingTasks;
use App\Filament\Resources\OnboardingTasks\Pages\ViewOnboardingTask;
use App\Filament\Resources\OnboardingTasks\Schemas\OnboardingTaskForm;
use App\Filament\Resources\OnboardingTasks\Schemas\OnboardingTaskInfolist;
use App\Filament\Resources\OnboardingTasks\Tables\OnboardingTasksTable;
use App\Models\OnboardingTask;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;


class OnboardingTaskResource extends Resource
{
    protected static ?string $model = OnboardingTask::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Onboarding';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return OnboardingTaskForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OnboardingTaskInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OnboardingTasksTable::configure($table);
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
            'index' => ListOnboardingTasks::route('/'),
            'create' => CreateOnboardingTask::route('/create'),
            'view' => ViewOnboardingTask::route('/{record}'),
            'edit' => EditOnboardingTask::route('/{record}/edit'),
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

<?php

namespace App\Filament\Resources\ApprovalSteps;

use App\Filament\Resources\ApprovalSteps\Pages\CreateApprovalStep;
use App\Filament\Resources\ApprovalSteps\Pages\EditApprovalStep;
use App\Filament\Resources\ApprovalSteps\Pages\ListApprovalSteps;
use App\Filament\Resources\ApprovalSteps\Pages\ViewApprovalStep;
use App\Filament\Resources\ApprovalSteps\RelationManagers\ActionsRelationManager;
use App\Filament\Resources\ApprovalSteps\Schemas\ApprovalStepForm;
use App\Filament\Resources\ApprovalSteps\Schemas\ApprovalStepInfolist;
use App\Filament\Resources\ApprovalSteps\Tables\ApprovalStepsTable;
use App\Models\ApprovalStep;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ApprovalStepResource extends Resource
{
    protected static ?string $model = ApprovalStep::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Workflows';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ApprovalStepForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ApprovalStepInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApprovalStepsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ActionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListApprovalSteps::route('/'),
            'create' => CreateApprovalStep::route('/create'),
            'view' => ViewApprovalStep::route('/{record}'),
            'edit' => EditApprovalStep::route('/{record}/edit'),
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

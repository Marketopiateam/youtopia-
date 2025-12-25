<?php

namespace App\Filament\Resources\ApprovalActions;

use App\Filament\Resources\ApprovalActions\Pages\CreateApprovalAction;
use App\Filament\Resources\ApprovalActions\Pages\EditApprovalAction;
use App\Filament\Resources\ApprovalActions\Pages\ListApprovalActions;
use App\Filament\Resources\ApprovalActions\Pages\ViewApprovalAction;
use App\Filament\Resources\ApprovalActions\Schemas\ApprovalActionForm;
use App\Filament\Resources\ApprovalActions\Schemas\ApprovalActionInfolist;
use App\Filament\Resources\ApprovalActions\Tables\ApprovalActionsTable;
use App\Models\ApprovalAction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ApprovalActionResource extends Resource
{
    protected static ?string $model = ApprovalAction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Workflows';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ApprovalActionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ApprovalActionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApprovalActionsTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListApprovalActions::route('/'),
            'create' => CreateApprovalAction::route('/create'),
            'view' => ViewApprovalAction::route('/{record}'),
            'edit' => EditApprovalAction::route('/{record}/edit'),
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

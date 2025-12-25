<?php

namespace App\Filament\Resources\ApprovalRequests;

use App\Filament\Resources\ApprovalRequests\Pages\CreateApprovalRequest;
use App\Filament\Resources\ApprovalRequests\Pages\EditApprovalRequest;
use App\Filament\Resources\ApprovalRequests\Pages\ListApprovalRequests;
use App\Filament\Resources\ApprovalRequests\Pages\ViewApprovalRequest;
use App\Filament\Resources\ApprovalRequests\RelationManagers\ActionsRelationManager;
use App\Filament\Resources\ApprovalRequests\Schemas\ApprovalRequestForm;
use App\Filament\Resources\ApprovalRequests\Schemas\ApprovalRequestInfolist;
use App\Filament\Resources\ApprovalRequests\Tables\ApprovalRequestsTable;
use App\Models\ApprovalRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ApprovalRequestResource extends Resource
{
    protected static ?string $model = ApprovalRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Workflows';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return ApprovalRequestForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ApprovalRequestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApprovalRequestsTable::configure($table);
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
            'index' => ListApprovalRequests::route('/'),
            'create' => CreateApprovalRequest::route('/create'),
            'view' => ViewApprovalRequest::route('/{record}'),
            'edit' => EditApprovalRequest::route('/{record}/edit'),
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

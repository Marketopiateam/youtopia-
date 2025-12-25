<?php

namespace App\Filament\Resources\WorklifeComments;

use App\Filament\Resources\WorklifeComments\Pages\CreateWorklifeComment;
use App\Filament\Resources\WorklifeComments\Pages\EditWorklifeComment;
use App\Filament\Resources\WorklifeComments\Pages\ListWorklifeComments;
use App\Filament\Resources\WorklifeComments\Pages\ViewWorklifeComment;
use App\Filament\Resources\WorklifeComments\RelationManagers\AttachmentsRelationManager;
use App\Filament\Resources\WorklifeComments\RelationManagers\ReactionsRelationManager;
use App\Filament\Resources\WorklifeComments\RelationManagers\RepliesRelationManager;
use App\Filament\Resources\WorklifeComments\Schemas\WorklifeCommentForm;
use App\Filament\Resources\WorklifeComments\Schemas\WorklifeCommentInfolist;
use App\Filament\Resources\WorklifeComments\Tables\WorklifeCommentsTable;
use App\Models\WorklifeComment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;


class WorklifeCommentResource extends Resource
{
    protected static ?string $model = WorklifeComment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Social';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return WorklifeCommentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WorklifeCommentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorklifeCommentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RepliesRelationManager::class,
            ReactionsRelationManager::class,
            AttachmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWorklifeComments::route('/'),
            'create' => CreateWorklifeComment::route('/create'),
            'view' => ViewWorklifeComment::route('/{record}'),
            'edit' => EditWorklifeComment::route('/{record}/edit'),
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

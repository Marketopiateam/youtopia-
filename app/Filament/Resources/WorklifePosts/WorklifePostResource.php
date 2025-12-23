<?php

namespace App\Filament\Resources\WorklifePosts;

use App\Filament\Resources\WorklifePosts\Pages\CreateWorklifePost;
use App\Filament\Resources\WorklifePosts\Pages\EditWorklifePost;
use App\Filament\Resources\WorklifePosts\Pages\ListWorklifePosts;
use App\Filament\Resources\WorklifePosts\Pages\ViewWorklifePost;
use App\Filament\Resources\WorklifePosts\Schemas\WorklifePostForm;
use App\Filament\Resources\WorklifePosts\Schemas\WorklifePostInfolist;
use App\Filament\Resources\WorklifePosts\Tables\WorklifePostsTable;
use App\Models\WorklifePost;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorklifePostResource extends Resource
{
    protected static ?string $model = WorklifePost::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationGroup = 'Social';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return WorklifePostForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WorklifePostInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorklifePostsTable::configure($table);
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
            'index' => ListWorklifePosts::route('/'),
            'create' => CreateWorklifePost::route('/create'),
            'view' => ViewWorklifePost::route('/{record}'),
            'edit' => EditWorklifePost::route('/{record}/edit'),
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

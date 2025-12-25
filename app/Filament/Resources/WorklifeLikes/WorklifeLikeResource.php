<?php

namespace App\Filament\Resources\WorklifeLikes;

use App\Filament\Resources\WorklifeLikes\Pages\CreateWorklifeLike;
use App\Filament\Resources\WorklifeLikes\Pages\EditWorklifeLike;
use App\Filament\Resources\WorklifeLikes\Pages\ListWorklifeLikes;
use App\Filament\Resources\WorklifeLikes\Pages\ViewWorklifeLike;
use App\Filament\Resources\WorklifeLikes\Schemas\WorklifeLikeForm;
use App\Filament\Resources\WorklifeLikes\Schemas\WorklifeLikeInfolist;
use App\Filament\Resources\WorklifeLikes\Tables\WorklifeLikesTable;
use App\Models\WorklifeLike;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class WorklifeLikeResource extends Resource
{
    protected static ?string $model = WorklifeLike::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Social';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return WorklifeLikeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WorklifeLikeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorklifeLikesTable::configure($table);
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
            'index' => ListWorklifeLikes::route('/'),
            'create' => CreateWorklifeLike::route('/create'),
            'view' => ViewWorklifeLike::route('/{record}'),
            'edit' => EditWorklifeLike::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\WorklifeReactions;

use App\Filament\Resources\WorklifeReactions\Pages\CreateWorklifeReaction;
use App\Filament\Resources\WorklifeReactions\Pages\EditWorklifeReaction;
use App\Filament\Resources\WorklifeReactions\Pages\ListWorklifeReactions;
use App\Filament\Resources\WorklifeReactions\Pages\ViewWorklifeReaction;
use App\Filament\Resources\WorklifeReactions\Schemas\WorklifeReactionForm;
use App\Filament\Resources\WorklifeReactions\Schemas\WorklifeReactionInfolist;
use App\Filament\Resources\WorklifeReactions\Tables\WorklifeReactionsTable;
use App\Models\WorklifeReaction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class WorklifeReactionResource extends Resource
{
    protected static ?string $model = WorklifeReaction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Social';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return WorklifeReactionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WorklifeReactionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WorklifeReactionsTable::configure($table);
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
            'index' => ListWorklifeReactions::route('/'),
            'create' => CreateWorklifeReaction::route('/create'),
            'view' => ViewWorklifeReaction::route('/{record}'),
            'edit' => EditWorklifeReaction::route('/{record}/edit'),
        ];
    }
}

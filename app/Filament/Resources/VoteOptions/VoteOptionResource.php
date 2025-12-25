<?php

namespace App\Filament\Resources\VoteOptions;

use App\Filament\Resources\VoteOptions\Pages\CreateVoteOption;
use App\Filament\Resources\VoteOptions\Pages\EditVoteOption;
use App\Filament\Resources\VoteOptions\Pages\ListVoteOptions;
use App\Filament\Resources\VoteOptions\Pages\ViewVoteOption;
use App\Filament\Resources\VoteOptions\RelationManagers\BallotsRelationManager;
use App\Filament\Resources\VoteOptions\Schemas\VoteOptionForm;
use App\Filament\Resources\VoteOptions\Schemas\VoteOptionInfolist;
use App\Filament\Resources\VoteOptions\Tables\VoteOptionsTable;
use App\Models\VoteOption;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class VoteOptionResource extends Resource
{
    protected static ?string $model = VoteOption::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Communication';

    protected static ?string $recordTitleAttribute = 'option_text';

    public static function form(Schema $schema): Schema
    {
        return VoteOptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VoteOptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VoteOptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            BallotsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVoteOptions::route('/'),
            'create' => CreateVoteOption::route('/create'),
            'view' => ViewVoteOption::route('/{record}'),
            'edit' => EditVoteOption::route('/{record}/edit'),
        ];
    }
}

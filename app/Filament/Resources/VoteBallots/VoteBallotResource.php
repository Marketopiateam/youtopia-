<?php

namespace App\Filament\Resources\VoteBallots;

use App\Filament\Resources\VoteBallots\Pages\CreateVoteBallot;
use App\Filament\Resources\VoteBallots\Pages\EditVoteBallot;
use App\Filament\Resources\VoteBallots\Pages\ListVoteBallots;
use App\Filament\Resources\VoteBallots\Pages\ViewVoteBallot;
use App\Filament\Resources\VoteBallots\Schemas\VoteBallotForm;
use App\Filament\Resources\VoteBallots\Schemas\VoteBallotInfolist;
use App\Filament\Resources\VoteBallots\Tables\VoteBallotsTable;
use App\Models\VoteBallot;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class VoteBallotResource extends Resource
{
    protected static ?string $model = VoteBallot::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Communication';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return VoteBallotForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VoteBallotInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VoteBallotsTable::configure($table);
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
            'index' => ListVoteBallots::route('/'),
            'create' => CreateVoteBallot::route('/create'),
            'view' => ViewVoteBallot::route('/{record}'),
            'edit' => EditVoteBallot::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\Votes;

use App\Filament\Resources\Votes\Pages\CreateVote;
use App\Filament\Resources\Votes\Pages\EditVote;
use App\Filament\Resources\Votes\Pages\ListVotes;
use App\Filament\Resources\Votes\Pages\ViewVote;
use App\Filament\Resources\Votes\RelationManagers\BallotsRelationManager;
use App\Filament\Resources\Votes\RelationManagers\OptionsRelationManager;
use App\Filament\Resources\Votes\Schemas\VoteForm;
use App\Filament\Resources\Votes\Schemas\VoteInfolist;
use App\Filament\Resources\Votes\Tables\VotesTable;
use App\Models\Vote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;


class VoteResource extends Resource
{
    protected static ?string $model = Vote::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;


    protected static string|UnitEnum|null $navigationGroup = 'Communication';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return VoteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VoteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VotesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            OptionsRelationManager::class,
            BallotsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVotes::route('/'),
            'create' => CreateVote::route('/create'),
            'view' => ViewVote::route('/{record}'),
            'edit' => EditVote::route('/{record}/edit'),
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

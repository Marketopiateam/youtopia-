<?php

namespace App\Filament\Resources\GoalLinks;

use App\Filament\Resources\GoalLinks\Pages\CreateGoalLink;
use App\Filament\Resources\GoalLinks\Pages\EditGoalLink;
use App\Filament\Resources\GoalLinks\Pages\ListGoalLinks;
use App\Filament\Resources\GoalLinks\Pages\ViewGoalLink;
use App\Filament\Resources\GoalLinks\Schemas\GoalLinkForm;
use App\Filament\Resources\GoalLinks\Schemas\GoalLinkInfolist;
use App\Filament\Resources\GoalLinks\Tables\GoalLinksTable;
use App\Models\GoalLink;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class GoalLinkResource extends Resource
{
    protected static ?string $model = GoalLink::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Strategy';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return GoalLinkForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GoalLinkInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GoalLinksTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGoalLinks::route('/'),
            'create' => CreateGoalLink::route('/create'),
            'view' => ViewGoalLink::route('/{record}'),
            'edit' => EditGoalLink::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\MeetingActionItems;

use App\Filament\Resources\MeetingActionItems\Pages\CreateMeetingActionItem;
use App\Filament\Resources\MeetingActionItems\Pages\EditMeetingActionItem;
use App\Filament\Resources\MeetingActionItems\Pages\ListMeetingActionItems;
use App\Filament\Resources\MeetingActionItems\Pages\ViewMeetingActionItem;
use App\Filament\Resources\MeetingActionItems\Schemas\MeetingActionItemForm;
use App\Filament\Resources\MeetingActionItems\Schemas\MeetingActionItemInfolist;
use App\Filament\Resources\MeetingActionItems\Tables\MeetingActionItemsTable;
use App\Models\MeetingActionItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MeetingActionItemResource extends Resource
{
    protected static ?string $model = MeetingActionItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Meetings';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return MeetingActionItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MeetingActionItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MeetingActionItemsTable::configure($table);
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
            'index' => ListMeetingActionItems::route('/'),
            'create' => CreateMeetingActionItem::route('/create'),
            'view' => ViewMeetingActionItem::route('/{record}'),
            'edit' => EditMeetingActionItem::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\MeetingAgendaItems;

use App\Filament\Resources\MeetingAgendaItems\Pages\CreateMeetingAgendaItem;
use App\Filament\Resources\MeetingAgendaItems\Pages\EditMeetingAgendaItem;
use App\Filament\Resources\MeetingAgendaItems\Pages\ListMeetingAgendaItems;
use App\Filament\Resources\MeetingAgendaItems\Pages\ViewMeetingAgendaItem;
use App\Filament\Resources\MeetingAgendaItems\Schemas\MeetingAgendaItemForm;
use App\Filament\Resources\MeetingAgendaItems\Schemas\MeetingAgendaItemInfolist;
use App\Filament\Resources\MeetingAgendaItems\Tables\MeetingAgendaItemsTable;
use App\Models\MeetingAgendaItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MeetingAgendaItemResource extends Resource
{
    protected static ?string $model = MeetingAgendaItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Meetings';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return MeetingAgendaItemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MeetingAgendaItemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MeetingAgendaItemsTable::configure($table);
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
            'index' => ListMeetingAgendaItems::route('/'),
            'create' => CreateMeetingAgendaItem::route('/create'),
            'view' => ViewMeetingAgendaItem::route('/{record}'),
            'edit' => EditMeetingAgendaItem::route('/{record}/edit'),
        ];
    }
}

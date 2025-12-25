<?php

namespace App\Filament\Resources\MeetingAttendees;

use App\Filament\Resources\MeetingAttendees\Pages\CreateMeetingAttendee;
use App\Filament\Resources\MeetingAttendees\Pages\EditMeetingAttendee;
use App\Filament\Resources\MeetingAttendees\Pages\ListMeetingAttendees;
use App\Filament\Resources\MeetingAttendees\Pages\ViewMeetingAttendee;
use App\Filament\Resources\MeetingAttendees\Schemas\MeetingAttendeeForm;
use App\Filament\Resources\MeetingAttendees\Schemas\MeetingAttendeeInfolist;
use App\Filament\Resources\MeetingAttendees\Tables\MeetingAttendeesTable;
use App\Models\MeetingAttendee;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MeetingAttendeeResource extends Resource
{
    protected static ?string $model = MeetingAttendee::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Meetings';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return MeetingAttendeeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MeetingAttendeeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MeetingAttendeesTable::configure($table);
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
            'index' => ListMeetingAttendees::route('/'),
            'create' => CreateMeetingAttendee::route('/create'),
            'view' => ViewMeetingAttendee::route('/{record}'),
            'edit' => EditMeetingAttendee::route('/{record}/edit'),
        ];
    }
}

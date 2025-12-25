<?php

namespace App\Filament\Resources\MeetingAttendees\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MeetingAttendeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('meeting.title')
                    ->label('Meeting')
                    ->placeholder('-'),
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('attendance_status')
                    ->label('Attendance status')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

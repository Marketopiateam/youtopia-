<?php

namespace App\Filament\Resources\MeetingAttendees\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class MeetingAttendeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('meeting_id')
                    ->label('Meeting')
                    ->relationship('meeting', 'title')
                    ->searchable()
                    ->required(),
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('attendance_status')
                    ->label('Attendance status')
                    ->options([
                        'invited' => 'Invited',
                        'accepted' => 'Accepted',
                        'declined' => 'Declined',
                        'attended' => 'Attended',
                        'absent' => 'Absent',
                    ])
                    ->default('invited')
                    ->required(),
            ]);
    }
}

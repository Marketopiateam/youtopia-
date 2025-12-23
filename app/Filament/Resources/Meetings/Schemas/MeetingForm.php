<?php

namespace App\Filament\Resources\Meetings\Schemas;

use App\Enums\MeetingStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MeetingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                DateTimePicker::make('scheduled_at')
                    ->required(),
                TextInput::make('duration_minutes')
                    ->numeric(),
                TextInput::make('location')
                    ->maxLength(255),
                TextInput::make('meeting_link')
                    ->maxLength(255),
                Select::make('organizer_employee_id')
                    ->relationship('organizer', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('status')
                    ->options(MeetingStatus::class)
                    ->default('scheduled')
                    ->required(),
            ]);
    }
}

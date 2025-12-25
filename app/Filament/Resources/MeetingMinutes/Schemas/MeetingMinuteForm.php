<?php

namespace App\Filament\Resources\MeetingMinutes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MeetingMinuteForm
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
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
                Select::make('recorded_by_employee_id')
                    ->label('Recorded by')
                    ->relationship('recordedBy', 'employee_code')
                    ->searchable()
                    ->required(),
            ]);
    }
}

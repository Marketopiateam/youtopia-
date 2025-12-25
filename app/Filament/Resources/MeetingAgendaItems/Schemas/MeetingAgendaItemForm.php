<?php

namespace App\Filament\Resources\MeetingAgendaItems\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MeetingAgendaItemForm
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
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('order')
                    ->numeric()
                    ->required()
                    ->default(0),
                TextInput::make('duration_minutes')
                    ->numeric()
                    ->minValue(1),
            ]);
    }
}

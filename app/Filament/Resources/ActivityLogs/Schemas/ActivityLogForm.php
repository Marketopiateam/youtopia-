<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ActivityLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('actor_user_id')
                    ->label('Actor')
                    ->relationship('actor', 'name')
                    ->searchable(),
                TextInput::make('action')
                    ->required()
                    ->maxLength(255),
                TextInput::make('subject_type')
                    ->label('Subject type')
                    ->required()
                    ->maxLength(255),
                TextInput::make('subject_id')
                    ->label('Subject ID')
                    ->numeric()
                    ->required(),
                KeyValue::make('properties')
                    ->nullable()
                    ->columnSpanFull(),
                TextInput::make('ip_address')
                    ->label('IP address')
                    ->maxLength(45),
                Textarea::make('user_agent')
                    ->label('User agent')
                    ->columnSpanFull(),
                DateTimePicker::make('created_at')
                    ->label('Created at')
                    ->required(),
            ]);
    }
}

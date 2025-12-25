<?php

namespace App\Filament\Resources\OkrCheckins\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OkrCheckinForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('key_result_id')
                    ->relationship('keyResult', 'title')
                    ->label('Key result')
                    ->required()
                    ->searchable(),
                Select::make('employee_id')
                    ->relationship('employee', 'employee_code')
                    ->required()
                    ->searchable(),
                TextInput::make('value')
                    ->numeric()
                    ->required(),
                DateTimePicker::make('checked_in_at')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\WorklifeGroups\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class WorklifeGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('created_by_employee_id')
                    ->label('Created by')
                    ->relationship('creator', 'employee_code')
                    ->searchable()
                    ->required(),
            ]);
    }
}

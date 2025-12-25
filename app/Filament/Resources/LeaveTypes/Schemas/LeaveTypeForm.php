<?php

namespace App\Filament\Resources\LeaveTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LeaveTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('code')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('days_per_year')
                    ->numeric()
                    ->required()
                    ->default(0),
                Toggle::make('requires_approval')
                    ->required()
                    ->default(true),
                Toggle::make('is_paid')
                    ->label('Paid')
                    ->required()
                    ->default(true),
                Toggle::make('is_active')
                    ->label('Active')
                    ->required()
                    ->default(true),
            ]);
    }
}

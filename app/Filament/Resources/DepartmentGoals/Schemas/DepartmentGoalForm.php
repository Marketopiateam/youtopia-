<?php

namespace App\Filament\Resources\DepartmentGoals\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DepartmentGoalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->required()
                    ->searchable(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('quarter')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(4)
                    ->required(),
                TextInput::make('year')
                    ->numeric()
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('draft')
                    ->maxLength(255),
                Select::make('owner_employee_id')
                    ->relationship('owner', 'employee_code')
                    ->label('Owner')
                    ->required()
                    ->searchable(),
            ]);
    }
}

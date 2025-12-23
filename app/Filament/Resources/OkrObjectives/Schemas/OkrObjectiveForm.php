<?php

namespace App\Filament\Resources\OkrObjectives\Schemas;

use App\Enums\OKRScope;
use App\Enums\OKRStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OkrObjectiveForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('cycle_id')
                    ->relationship('cycle', 'name')
                    ->required(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('scope')
                    ->options(OKRScope::class)
                    ->required(),
                TextInput::make('scope_id')
                    ->numeric(),
                Select::make('owner_employee_id')
                    ->relationship('owner', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('parent_objective_id')
                    ->relationship('parent', 'title')
                    ->searchable(),
                TextInput::make('progress_percentage')
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->options(OKRStatus::class)
                    ->default('draft')
                    ->required(),
            ]);
    }
}

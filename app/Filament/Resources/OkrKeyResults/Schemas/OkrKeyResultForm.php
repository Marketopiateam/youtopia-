<?php

namespace App\Filament\Resources\OkrKeyResults\Schemas;

use App\Enums\OKRStatus;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OkrKeyResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('objective_id')
                    ->relationship('objective', 'title')
                    ->required()
                    ->searchable(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('target_value')
                    ->numeric()
                    ->required(),
                TextInput::make('current_value')
                    ->numeric()
                    ->default(0)
                    ->required(),
                TextInput::make('unit')
                    ->maxLength(255),
                TextInput::make('weight_percentage')
                    ->numeric()
                    ->default(100)
                    ->required(),
                Select::make('status')
                    ->options(OKRStatus::class)
                    ->default(OKRStatus::Draft->value)
                    ->required(),
            ]);
    }
}

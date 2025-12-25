<?php

namespace App\Filament\Resources\Votes\Schemas;

use App\Enums\AudienceType;
use App\Enums\VoteStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class VoteForm
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
                Select::make('created_by_employee_id')
                    ->label('Created by')
                    ->relationship('creator', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('audience_type')
                    ->label('Audience type')
                    ->options(AudienceType::class)
                    ->default('company')
                    ->required(),
                TextInput::make('audience_id')
                    ->label('Audience ID')
                    ->numeric(),
                DateTimePicker::make('starts_at'),
                DateTimePicker::make('ends_at'),
                Toggle::make('is_anonymous')
                    ->label('Anonymous')
                    ->required()
                    ->default(false),
                Select::make('status')
                    ->options(VoteStatus::class)
                    ->default('draft')
                    ->required(),
            ]);
    }
}

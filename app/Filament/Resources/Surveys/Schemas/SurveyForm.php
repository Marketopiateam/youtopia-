<?php

namespace App\Filament\Resources\Surveys\Schemas;

use App\Enums\AudienceType;
use App\Enums\SurveyStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SurveyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('created_by_employee_id')
                    ->required()
                    ->numeric(),
                Select::make('audience_type')
                    ->options(AudienceType::class)
                    ->default('company')
                    ->required(),
                TextInput::make('audience_id')
                    ->numeric(),
                DateTimePicker::make('starts_at'),
                DateTimePicker::make('ends_at'),
                Toggle::make('is_anonymous')
                    ->required(),
                Select::make('status')
                    ->options(SurveyStatus::class)
                    ->default('draft')
                    ->required(),
            ]);
    }
}

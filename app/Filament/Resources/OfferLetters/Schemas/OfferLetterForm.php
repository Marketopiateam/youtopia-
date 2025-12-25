<?php

namespace App\Filament\Resources\OfferLetters\Schemas;

use App\Enums\OfferStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OfferLetterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('application_id')
                    ->relationship('application', 'applicant_name')
                    ->label('Application')
                    ->required()
                    ->searchable(),
                TextInput::make('offered_position')
                    ->required()
                    ->maxLength(255),
                TextInput::make('salary_amount')
                    ->numeric()
                    ->required(),
                TextInput::make('currency_code')
                    ->maxLength(3)
                    ->default('USD')
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                Select::make('status')
                    ->options(OfferStatus::class)
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('sent_at'),
                DateTimePicker::make('accepted_at'),
                Textarea::make('terms')
                    ->columnSpanFull(),
            ]);
    }
}

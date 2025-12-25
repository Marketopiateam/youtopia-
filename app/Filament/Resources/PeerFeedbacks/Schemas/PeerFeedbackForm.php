<?php

namespace App\Filament\Resources\PeerFeedbacks\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PeerFeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->relationship('employee', 'employee_code')
                    ->required()
                    ->searchable(),
                Select::make('reviewer_employee_id')
                    ->relationship('reviewer', 'employee_code')
                    ->label('Reviewer')
                    ->required()
                    ->searchable(),
                Textarea::make('feedback_text')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('rating')
                    ->numeric(),
                Toggle::make('is_anonymous')
                    ->default(false)
                    ->required(),
                DateTimePicker::make('submitted_at')
                    ->required(),
            ]);
    }
}

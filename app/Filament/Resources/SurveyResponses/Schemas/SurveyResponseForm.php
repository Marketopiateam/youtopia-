<?php

namespace App\Filament\Resources\SurveyResponses\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class SurveyResponseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('survey_id')
                    ->label('Survey')
                    ->relationship('survey', 'title')
                    ->searchable()
                    ->required(),
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                DateTimePicker::make('submitted_at')
                    ->required(),
            ]);
    }
}

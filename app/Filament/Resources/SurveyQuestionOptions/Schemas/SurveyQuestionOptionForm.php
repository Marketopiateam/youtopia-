<?php

namespace App\Filament\Resources\SurveyQuestionOptions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SurveyQuestionOptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('survey_question_id')
                    ->label('Survey question')
                    ->relationship('question', 'question_text')
                    ->searchable()
                    ->required(),
                TextInput::make('option_text')
                    ->required()
                    ->maxLength(255),
                TextInput::make('order')
                    ->numeric()
                    ->required()
                    ->default(0),
            ]);
    }
}

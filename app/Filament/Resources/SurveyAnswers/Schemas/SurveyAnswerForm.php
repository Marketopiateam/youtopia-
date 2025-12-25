<?php

namespace App\Filament\Resources\SurveyAnswers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SurveyAnswerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('survey_response_id')
                    ->label('Survey response')
                    ->relationship('response', 'id')
                    ->searchable()
                    ->required(),
                Select::make('survey_question_id')
                    ->label('Survey question')
                    ->relationship('question', 'question_text')
                    ->searchable()
                    ->required(),
                Textarea::make('answer_text')
                    ->label('Answer text')
                    ->columnSpanFull(),
                Select::make('survey_question_option_id')
                    ->label('Selected option')
                    ->relationship('option', 'option_text')
                    ->searchable(),
            ]);
    }
}

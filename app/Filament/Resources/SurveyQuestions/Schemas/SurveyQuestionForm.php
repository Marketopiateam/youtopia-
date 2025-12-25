<?php

namespace App\Filament\Resources\SurveyQuestions\Schemas;

use App\Enums\QuestionType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SurveyQuestionForm
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
                Textarea::make('question_text')
                    ->label('Question')
                    ->required()
                    ->columnSpanFull(),
                Select::make('question_type')
                    ->label('Question type')
                    ->options(QuestionType::class)
                    ->default('text')
                    ->required(),
                Toggle::make('is_required')
                    ->label('Required')
                    ->required()
                    ->default(false),
                TextInput::make('order')
                    ->numeric()
                    ->required()
                    ->default(0),
            ]);
    }
}

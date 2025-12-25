<?php

namespace App\Filament\Resources\SurveyQuestions\Schemas;

use App\Enums\QuestionType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SurveyQuestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('survey.title')
                    ->label('Survey')
                    ->placeholder('-'),
                TextEntry::make('question_text')
                    ->label('Question')
                    ->columnSpanFull(),
                TextEntry::make('question_type')
                    ->label('Question type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof QuestionType ? $state->value : (string) $state;

                        return QuestionType::tryFrom($value)?->name ?? $value;
                    }),
                TextEntry::make('is_required')
                    ->label('Required')
                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
                TextEntry::make('order'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

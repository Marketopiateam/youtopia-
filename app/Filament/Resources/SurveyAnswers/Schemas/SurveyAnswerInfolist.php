<?php

namespace App\Filament\Resources\SurveyAnswers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SurveyAnswerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('response.id')
                    ->label('Survey response')
                    ->placeholder('-'),
                TextEntry::make('question.question_text')
                    ->label('Survey question')
                    ->placeholder('-'),
                TextEntry::make('option.option_text')
                    ->label('Selected option')
                    ->placeholder('-'),
                TextEntry::make('answer_text')
                    ->label('Answer text')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

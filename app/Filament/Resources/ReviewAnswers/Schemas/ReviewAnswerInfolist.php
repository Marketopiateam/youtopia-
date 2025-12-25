<?php

namespace App\Filament\Resources\ReviewAnswers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReviewAnswerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('review.id')
                    ->label('Review'),
                TextEntry::make('review.employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('question.question_text')
                    ->label('Question')
                    ->columnSpanFull(),
                TextEntry::make('answer_text')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('rating')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

<?php

namespace App\Filament\Resources\ReviewAnswers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReviewAnswerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('review_id')
                    ->relationship('review', 'id')
                    ->label('Review')
                    ->required()
                    ->searchable(),
                Select::make('question_id')
                    ->relationship('question', 'question_text')
                    ->label('Question')
                    ->required()
                    ->searchable(),
                Textarea::make('answer_text')
                    ->columnSpanFull(),
                TextInput::make('rating')
                    ->numeric(),
            ]);
    }
}

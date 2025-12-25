<?php

namespace App\Filament\Resources\ReviewQuestions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReviewQuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('template_id')
                    ->relationship('template', 'name')
                    ->required()
                    ->searchable(),
                Textarea::make('question_text')
                    ->required()
                    ->columnSpanFull(),
                Select::make('question_type')
                    ->options([
                        'text' => 'Text',
                        'rating' => 'Rating',
                        'multiple_choice' => 'Multiple choice',
                    ])
                    ->required(),
                TextInput::make('weight')
                    ->numeric()
                    ->default(1)
                    ->required(),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }
}

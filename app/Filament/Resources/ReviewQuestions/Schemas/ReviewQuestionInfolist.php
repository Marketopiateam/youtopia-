<?php

namespace App\Filament\Resources\ReviewQuestions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ReviewQuestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('template.name')
                    ->label('Template'),
                TextEntry::make('question_text')
                    ->label('Question')
                    ->columnSpanFull(),
                TextEntry::make('question_type')
                    ->formatStateUsing(fn (?string $state) => $state ? Str::headline($state) : '-'),
                TextEntry::make('weight')
                    ->numeric(),
                TextEntry::make('order')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

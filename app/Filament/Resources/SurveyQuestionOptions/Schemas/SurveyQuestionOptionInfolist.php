<?php

namespace App\Filament\Resources\SurveyQuestionOptions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SurveyQuestionOptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('question.question_text')
                    ->label('Survey question')
                    ->placeholder('-'),
                TextEntry::make('option_text'),
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

<?php

namespace App\Filament\Resources\SurveyResponses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SurveyResponseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('survey.title')
                    ->label('Survey')
                    ->placeholder('-'),
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('submitted_at')
                    ->dateTime()
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

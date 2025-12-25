<?php

namespace App\Filament\Resources\VoteBallots\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VoteBallotInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('vote.title')
                    ->label('Vote')
                    ->placeholder('-'),
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('option.option_text')
                    ->label('Option')
                    ->placeholder('-'),
                TextEntry::make('voted_at')
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

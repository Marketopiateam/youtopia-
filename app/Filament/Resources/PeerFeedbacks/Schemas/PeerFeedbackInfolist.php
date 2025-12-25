<?php

namespace App\Filament\Resources\PeerFeedbacks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PeerFeedbackInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('employee.employee_code')
                    ->label('Employee'),
                TextEntry::make('reviewer.employee_code')
                    ->label('Reviewer'),
                TextEntry::make('rating')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('is_anonymous')
                    ->badge()
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Anonymous' : 'Identified'),
                TextEntry::make('submitted_at')
                    ->dateTime(),
                TextEntry::make('feedback_text')
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

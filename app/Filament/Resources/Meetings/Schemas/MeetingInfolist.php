<?php

namespace App\Filament\Resources\Meetings\Schemas;

use App\Enums\MeetingStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MeetingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('scheduled_at')
                    ->dateTime(),
                TextEntry::make('duration_minutes')
                    ->numeric(),
                TextEntry::make('location')
                    ->placeholder('-'),
                TextEntry::make('meeting_link')
                    ->placeholder('-'),
                TextEntry::make('organizer.employee_code')
                    ->label('Organizer'),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof MeetingStatus ? $state->value : (string) $state;

                        return MeetingStatus::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

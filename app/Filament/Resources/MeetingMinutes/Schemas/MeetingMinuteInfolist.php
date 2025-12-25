<?php

namespace App\Filament\Resources\MeetingMinutes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MeetingMinuteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('meeting.title')
                    ->label('Meeting')
                    ->placeholder('-'),
                TextEntry::make('recordedBy.employee_code')
                    ->label('Recorded by')
                    ->placeholder('-'),
                TextEntry::make('content')
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

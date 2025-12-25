<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ActivityLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('action'),
                TextEntry::make('actor.name')
                    ->label('Actor')
                    ->placeholder('-'),
                TextEntry::make('subject_type')
                    ->label('Subject type'),
                TextEntry::make('subject_id')
                    ->label('Subject ID'),
                TextEntry::make('properties')
                    ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_UNESCAPED_SLASHES) : '-')
                    ->columnSpanFull(),
                TextEntry::make('ip_address')
                    ->label('IP address')
                    ->placeholder('-'),
                TextEntry::make('user_agent')
                    ->label('User agent')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

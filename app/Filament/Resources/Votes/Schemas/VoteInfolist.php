<?php

namespace App\Filament\Resources\Votes\Schemas;

use App\Enums\AudienceType;
use App\Enums\VoteStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VoteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('creator.employee_code')
                    ->label('Created by')
                    ->placeholder('-'),
                TextEntry::make('audience_type')
                    ->label('Audience type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof AudienceType ? $state->value : (string) $state;

                        return AudienceType::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('audience_id')
                    ->label('Audience ID')
                    ->placeholder('-'),
                TextEntry::make('starts_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('ends_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('is_anonymous')
                    ->label('Anonymous')
                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof VoteStatus ? $state->value : (string) $state;

                        return VoteStatus::tryFrom($value)?->name ?? $value;
                    }),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

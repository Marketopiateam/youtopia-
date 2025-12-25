<?php

namespace App\Filament\Resources\OkrKeyResults\Schemas;

use App\Enums\OKRStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OkrKeyResultInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('objective.title')
                    ->label('Objective'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('target_value')
                    ->numeric(),
                TextEntry::make('current_value')
                    ->numeric(),
                TextEntry::make('unit')
                    ->placeholder('-'),
                TextEntry::make('weight_percentage')
                    ->numeric(),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof OKRStatus ? $state->value : (string) $state;

                        return OKRStatus::tryFrom($value)?->label() ?? $value;
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

<?php

namespace App\Filament\Resources\OkrObjectives\Schemas;

use App\Enums\OKRScope;
use App\Enums\OKRStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OkrObjectiveInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('cycle.name')
                    ->label('Cycle'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('scope')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof OKRScope ? $state->value : (string) $state;

                        return OKRScope::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('scope_id'),
                TextEntry::make('owner.employee_code')
                    ->label('Owner'),
                TextEntry::make('parent.title')
                    ->label('Parent objective')
                    ->placeholder('-'),
                TextEntry::make('progress_percentage')
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

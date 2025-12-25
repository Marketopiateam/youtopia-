<?php

namespace App\Filament\Resources\GoalLinks\Schemas;

use App\Enums\GoalType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GoalLinkInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('goal_type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof GoalType ? $state->value : (string) $state;

                        return GoalType::tryFrom($value)?->label() ?? Str::headline($value);
                    }),
                TextEntry::make('goal_id')
                    ->label('Goal')
                    ->formatStateUsing(function ($state, $record) {
                        if (! $record) {
                            return '-';
                        }

                        if ($record->goal_type === GoalType::Company->value) {
                            return $record->companyGoal?->title ?? '-';
                        }

                        if ($record->goal_type === GoalType::Department->value) {
                            return $record->departmentGoal?->title ?? '-';
                        }

                        return '-';
                    }),
                TextEntry::make('objective.title')
                    ->label('Objective'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

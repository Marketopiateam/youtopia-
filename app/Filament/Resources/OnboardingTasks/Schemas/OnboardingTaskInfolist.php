<?php

namespace App\Filament\Resources\OnboardingTasks\Schemas;

use App\Enums\OnboardingTaskStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OnboardingTaskInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('assignedBy.employee_code')
                    ->label('Assigned by')
                    ->placeholder('-'),
                TextEntry::make('due_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof OnboardingTaskStatus ? $state->value : (string) $state;

                        return OnboardingTaskStatus::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('completed_at')
                    ->dateTime()
                    ->placeholder('-'),
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

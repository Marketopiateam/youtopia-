<?php

namespace App\Filament\Resources\PerformanceReviews\Schemas;

use App\Enums\ReviewStatus;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PerformanceReviewInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('template.name')
                    ->label('Template'),
                TextEntry::make('employee.employee_code')
                    ->label('Employee'),
                TextEntry::make('reviewer.employee_code')
                    ->label('Reviewer'),
                TextEntry::make('review_period_start')
                    ->date(),
                TextEntry::make('review_period_end')
                    ->date(),
                TextEntry::make('overall_rating')
                    ->numeric(),
                TextEntry::make('summary')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ReviewStatus ? $state->value : (string) $state;

                        return ReviewStatus::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('submitted_at')
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

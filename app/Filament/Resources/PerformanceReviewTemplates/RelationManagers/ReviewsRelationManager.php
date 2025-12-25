<?php

namespace App\Filament\Resources\PerformanceReviewTemplates\RelationManagers;

use App\Enums\ReviewStatus;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';

    protected static ?string $title = 'Reviews';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.employee_code')
                    ->label('Employee')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reviewer.employee_code')
                    ->label('Reviewer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('review_period_start')
                    ->date()
                    ->sortable(),
                TextColumn::make('review_period_end')
                    ->date()
                    ->sortable(),
                TextColumn::make('overall_rating')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ReviewStatus ? $state->value : (string) $state;

                        return ReviewStatus::tryFrom($value)?->label() ?? $value;
                    })
                    ->color(function ($state) {
                        $value = $state instanceof ReviewStatus ? $state->value : (string) $state;

                        return ReviewStatus::tryFrom($value)?->color() ?? 'gray';
                    })
                    ->sortable(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }
}

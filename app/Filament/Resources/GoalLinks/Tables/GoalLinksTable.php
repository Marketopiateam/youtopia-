<?php

namespace App\Filament\Resources\GoalLinks\Tables;

use App\Enums\GoalType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GoalLinksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('goal_type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof GoalType ? $state->value : (string) $state;

                        return GoalType::tryFrom($value)?->label() ?? Str::headline($value);
                    })
                    ->sortable(),
                TextColumn::make('goal_id')
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
                TextColumn::make('objective.title')
                    ->label('Objective')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('goal_type')
                    ->options(GoalType::class),
                SelectFilter::make('objective_id')
                    ->relationship('objective', 'title')
                    ->label('Objective'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

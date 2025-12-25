<?php

namespace App\Filament\Resources\ReviewAnswers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ReviewAnswersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('review.employee.employee_code')
                    ->label('Employee')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('question.question_text')
                    ->label('Question')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('rating')
                    ->numeric()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('review_id')
                    ->relationship('review', 'id')
                    ->label('Review'),
                SelectFilter::make('question_id')
                    ->relationship('question', 'question_text')
                    ->label('Question'),
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

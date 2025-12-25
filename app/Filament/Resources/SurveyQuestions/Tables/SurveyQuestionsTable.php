<?php

namespace App\Filament\Resources\SurveyQuestions\Tables;

use App\Enums\QuestionType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SurveyQuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('survey.title')
                    ->label('Survey')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('question_text')
                    ->label('Question')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('question_type')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof QuestionType ? $state->value : (string) $state;

                        return QuestionType::tryFrom($value)?->name ?? $value;
                    })
                    ->sortable(),
                IconColumn::make('is_required')
                    ->label('Required')
                    ->boolean(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
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
                SelectFilter::make('survey_id')
                    ->label('Survey')
                    ->relationship('survey', 'title'),
                SelectFilter::make('question_type')
                    ->options(QuestionType::class),
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

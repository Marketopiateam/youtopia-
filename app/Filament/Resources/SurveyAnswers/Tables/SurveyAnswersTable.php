<?php

namespace App\Filament\Resources\SurveyAnswers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SurveyAnswersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('response.id')
                    ->label('Response')
                    ->sortable(),
                TextColumn::make('question.question_text')
                    ->label('Question')
                    ->limit(40)
                    ->searchable(),
                TextColumn::make('option.option_text')
                    ->label('Option')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('answer_text')
                    ->label('Answer')
                    ->limit(60),
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
                SelectFilter::make('survey_response_id')
                    ->label('Response')
                    ->relationship('response', 'id'),
                SelectFilter::make('survey_question_id')
                    ->label('Question')
                    ->relationship('question', 'question_text'),
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

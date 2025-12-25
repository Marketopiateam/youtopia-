<?php

namespace App\Filament\Resources\ReviewQuestions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ReviewQuestionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question_text')
                    ->label('Question')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('template.name')
                    ->label('Template')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('question_type')
                    ->formatStateUsing(fn (?string $state) => $state ? Str::headline($state) : '-')
                    ->sortable(),
                TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('template_id')
                    ->relationship('template', 'name')
                    ->label('Template'),
                SelectFilter::make('question_type')
                    ->options([
                        'text' => 'Text',
                        'rating' => 'Rating',
                        'multiple_choice' => 'Multiple choice',
                    ]),
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

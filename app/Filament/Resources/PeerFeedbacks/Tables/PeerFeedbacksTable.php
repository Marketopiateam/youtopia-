<?php

namespace App\Filament\Resources\PeerFeedbacks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PeerFeedbacksTable
{
    public static function configure(Table $table): Table
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
                TextColumn::make('rating')
                    ->numeric()
                    ->sortable()
                    ->placeholder('-'),
                IconColumn::make('is_anonymous')
                    ->boolean(),
                TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('employee_id')
                    ->relationship('employee', 'employee_code')
                    ->label('Employee'),
                SelectFilter::make('reviewer_employee_id')
                    ->relationship('reviewer', 'employee_code')
                    ->label('Reviewer'),
                TernaryFilter::make('is_anonymous'),
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

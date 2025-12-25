<?php

namespace App\Filament\Resources\MeetingMinutes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MeetingMinutesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('meeting.title')
                    ->label('Meeting')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('recordedBy.employee_code')
                    ->label('Recorded by')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('content')
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
                SelectFilter::make('meeting_id')
                    ->label('Meeting')
                    ->relationship('meeting', 'title'),
                SelectFilter::make('recorded_by_employee_id')
                    ->label('Recorded by')
                    ->relationship('recordedBy', 'employee_code'),
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

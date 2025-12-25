<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use App\Models\ActivityLog;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('action')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('actor.name')
                    ->label('Actor')
                    ->searchable()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('subject_type')
                    ->label('Subject type')
                    ->searchable(),
                TextColumn::make('subject_id')
                    ->label('Subject ID')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ip_address')
                    ->label('IP address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('properties')
                    ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_UNESCAPED_SLASHES) : '-')
                    ->limit(40)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('action')
                    ->options(fn () => ActivityLog::query()
                        ->select('action')
                        ->distinct()
                        ->orderBy('action')
                        ->pluck('action', 'action')
                        ->toArray()),
                SelectFilter::make('actor_user_id')
                    ->label('Actor')
                    ->relationship('actor', 'name'),
                SelectFilter::make('subject_type')
                    ->label('Subject type')
                    ->options(fn () => ActivityLog::query()
                        ->select('subject_type')
                        ->distinct()
                        ->orderBy('subject_type')
                        ->pluck('subject_type', 'subject_type')
                        ->toArray()),
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

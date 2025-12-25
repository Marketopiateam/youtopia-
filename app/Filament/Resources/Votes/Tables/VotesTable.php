<?php

namespace App\Filament\Resources\Votes\Tables;

use App\Enums\AudienceType;
use App\Enums\VoteStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class VotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('creator.employee_code')
                    ->label('Created by')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof VoteStatus ? $state->value : (string) $state;

                        return VoteStatus::tryFrom($value)?->name ?? $value;
                    })
                    ->sortable(),
                TextColumn::make('audience_type')
                    ->label('Audience type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof AudienceType ? $state->value : (string) $state;

                        return AudienceType::tryFrom($value)?->label() ?? $value;
                    })
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('audience_id')
                    ->label('Audience ID')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_anonymous')
                    ->label('Anonymous')
                    ->boolean(),
                TextColumn::make('starts_at')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('ends_at')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(VoteStatus::class),
                SelectFilter::make('audience_type')
                    ->options(AudienceType::class),
                SelectFilter::make('created_by_employee_id')
                    ->label('Created by')
                    ->relationship('creator', 'employee_code'),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}

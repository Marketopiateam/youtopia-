<?php

namespace App\Filament\Resources\OfferLetters\Tables;

use App\Enums\OfferStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class OfferLettersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('offered_position')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('application.applicant_name')
                    ->label('Applicant')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('salary_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('currency_code')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof OfferStatus ? $state->value : (string) $state;

                        return OfferStatus::tryFrom($value)?->label() ?? $value;
                    })
                    ->color(function ($state) {
                        $value = $state instanceof OfferStatus ? $state->value : (string) $state;

                        return OfferStatus::tryFrom($value)?->color() ?? 'gray';
                    })
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('sent_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
                    ->options(OfferStatus::class),
                SelectFilter::make('application_id')
                    ->relationship('application', 'applicant_name')
                    ->label('Applicant'),
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

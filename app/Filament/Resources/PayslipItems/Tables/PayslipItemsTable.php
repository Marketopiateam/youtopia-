<?php

namespace App\Filament\Resources\PayslipItems\Tables;

use App\Enums\PayslipItemType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PayslipItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('payslip.id')
                    ->label('Payslip')
                    ->sortable(),
                TextColumn::make('item_type')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof PayslipItemType ? $state->value : (string) $state;

                        return PayslipItemType::tryFrom($value)?->label() ?? $value;
                    })
                    ->color(function ($state) {
                        $value = $state instanceof PayslipItemType ? $state->value : (string) $state;

                        return PayslipItemType::tryFrom($value)?->color() ?? 'gray';
                    })
                    ->sortable(),
                TextColumn::make('type_id')
                    ->label('Type')
                    ->formatStateUsing(function ($state, $record) {
                        if (! $record) {
                            return '-';
                        }

                        if ($record->item_type?->value === PayslipItemType::Earning->value) {
                            return $record->allowanceType?->name ?? '-';
                        }

                        if ($record->item_type?->value === PayslipItemType::Deduction->value) {
                            return $record->deductionType?->name ?? '-';
                        }

                        return '-';
                    }),
                TextColumn::make('amount')
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
                SelectFilter::make('item_type')
                    ->options(PayslipItemType::class),
                SelectFilter::make('payslip_id')
                    ->relationship('payslip', 'id')
                    ->label('Payslip'),
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

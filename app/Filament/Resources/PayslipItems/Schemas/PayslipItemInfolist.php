<?php

namespace App\Filament\Resources\PayslipItems\Schemas;

use App\Enums\PayslipItemType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PayslipItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('payslip.id')
                    ->label('Payslip'),
                TextEntry::make('item_type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof PayslipItemType ? $state->value : (string) $state;

                        return PayslipItemType::tryFrom($value)?->label() ?? $value;
                    }),
                TextEntry::make('type_id')
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
                TextEntry::make('amount')
                    ->numeric(),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

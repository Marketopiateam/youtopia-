<?php

namespace App\Filament\Resources\PayslipItems\Schemas;

use App\Enums\PayslipItemType;
use App\Models\AllowanceType;
use App\Models\DeductionType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Schemas\Schema;

class PayslipItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('payslip_id')
                    ->relationship('payslip', 'id')
                    ->required()
                    ->searchable(),
                Select::make('item_type')
                    ->options(PayslipItemType::class)
                    ->default('earning')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Set $set) => $set('type_id', null)),
                Select::make('type_id')
                    ->label('Type')
                    ->required()
                    ->searchable()
                    ->options(function (Get $get): array {
                        $itemType = $get('item_type');

                        if ($itemType === PayslipItemType::Earning->value) {
                            return AllowanceType::query()
                                ->where('is_active', true)
                                ->orderBy('name')
                                ->pluck('name', 'id')
                                ->all();
                        }

                        if ($itemType === PayslipItemType::Deduction->value) {
                            return DeductionType::query()
                                ->where('is_active', true)
                                ->orderBy('name')
                                ->pluck('name', 'id')
                                ->all();
                        }

                        return [];
                    }),
                TextInput::make('amount')
                    ->numeric()
                    ->required(),
                TextInput::make('description')
                    ->maxLength(255),
            ]);
    }
}

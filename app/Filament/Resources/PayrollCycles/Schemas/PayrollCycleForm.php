<?php

namespace App\Filament\Resources\PayrollCycles\Schemas;

use App\Enums\PayrollCycleStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PayrollCycleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('year')
                    ->required()
                    ->numeric(),
                TextInput::make('month')
                    ->required()
                    ->numeric(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date')
                    ->required(),
                Select::make('status')
                    ->options(PayrollCycleStatus::class)
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('processed_at'),
                TextInput::make('processed_by_employee_id')
                    ->numeric(),
            ]);
    }
}

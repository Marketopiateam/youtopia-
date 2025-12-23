<?php

namespace App\Filament\Resources\Payslips\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PayslipForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('payroll_cycle_id')
                    ->relationship('payrollCycle', 'id')
                    ->required(),
                Select::make('employee_id')
                    ->relationship('employee', 'id')
                    ->required(),
                TextInput::make('basic_salary')
                    ->required()
                    ->numeric(),
                TextInput::make('total_earnings')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total_deductions')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('net_salary')
                    ->required()
                    ->numeric(),
                TextInput::make('currency_code')
                    ->required()
                    ->default('USD'),
                DateTimePicker::make('generated_at')
                    ->required(),
            ]);
    }
}

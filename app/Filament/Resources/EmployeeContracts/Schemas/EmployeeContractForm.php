<?php

namespace App\Filament\Resources\EmployeeContracts\Schemas;

use App\Enums\ContractType;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeContractForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('contract_type')
                    ->label('Contract type')
                    ->options(ContractType::class)
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
                DatePicker::make('probation_end_date')
                    ->label('Probation end date'),
                TextInput::make('working_hours_per_week')
                    ->numeric()
                    ->step('0.01'),
                TextInput::make('base_salary')
                    ->numeric()
                    ->step('0.01')
                    ->required()
                    ->default(0),
                KeyValue::make('terms')
                    ->columnSpanFull(),
            ]);
    }
}

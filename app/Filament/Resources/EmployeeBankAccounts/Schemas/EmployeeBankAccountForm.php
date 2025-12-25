<?php

namespace App\Filament\Resources\EmployeeBankAccounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EmployeeBankAccountForm
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
                TextInput::make('bank_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('account_number')
                    ->required()
                    ->maxLength(255),
                TextInput::make('iban')
                    ->label('IBAN')
                    ->maxLength(255),
                TextInput::make('swift_code')
                    ->label('SWIFT code')
                    ->maxLength(255),
                Toggle::make('is_primary')
                    ->label('Primary')
                    ->required(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\SalaryHistories\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SalaryHistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->relationship('employee', 'employee_code')
                    ->required()
                    ->searchable(),
                TextInput::make('basic_salary')
                    ->numeric()
                    ->required(),
                TextInput::make('currency_code')
                    ->maxLength(3)
                    ->default('USD')
                    ->required(),
                DatePicker::make('effective_from')
                    ->required(),
                DatePicker::make('effective_to'),
                Select::make('changed_by_employee_id')
                    ->relationship('changedBy', 'employee_code')
                    ->label('Changed by')
                    ->searchable(),
                Textarea::make('reason')
                    ->columnSpanFull(),
            ]);
    }
}

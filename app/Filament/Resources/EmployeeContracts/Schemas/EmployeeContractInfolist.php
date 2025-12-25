<?php

namespace App\Filament\Resources\EmployeeContracts\Schemas;

use App\Enums\ContractType;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EmployeeContractInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('contract_type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ContractType ? $state->value : (string) $state;

                        return ContractType::tryFrom($value)?->name ?? $value;
                    }),
                TextEntry::make('start_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('end_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('probation_end_date')
                    ->label('Probation end date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('working_hours_per_week')
                    ->label('Working hours per week')
                    ->placeholder('-'),
                TextEntry::make('base_salary')
                    ->money('EGP'),
                TextEntry::make('terms')
                    ->formatStateUsing(fn ($state) => $state ? json_encode($state, JSON_UNESCAPED_SLASHES) : '-')
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

<?php

namespace App\Filament\Resources\Payslips\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PayslipInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('payrollCycle.id')
                    ->label('Payroll cycle'),
                TextEntry::make('employee.id')
                    ->label('Employee'),
                TextEntry::make('basic_salary')
                    ->numeric(),
                TextEntry::make('total_earnings')
                    ->numeric(),
                TextEntry::make('total_deductions')
                    ->numeric(),
                TextEntry::make('net_salary')
                    ->numeric(),
                TextEntry::make('currency_code'),
                TextEntry::make('generated_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

<?php

namespace App\Filament\Resources\EmployeeBankAccounts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EmployeeBankAccountInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('bank_name'),
                TextEntry::make('account_number'),
                TextEntry::make('iban')
                    ->label('IBAN')
                    ->placeholder('-'),
                TextEntry::make('swift_code')
                    ->label('SWIFT code')
                    ->placeholder('-'),
                TextEntry::make('is_primary')
                    ->label('Primary')
                    ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

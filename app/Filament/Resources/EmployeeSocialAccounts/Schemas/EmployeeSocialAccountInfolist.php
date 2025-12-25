<?php

namespace App\Filament\Resources\EmployeeSocialAccounts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EmployeeSocialAccountInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('platform'),
                TextEntry::make('username')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->placeholder('-'),
                TextEntry::make('url')
                    ->placeholder('-'),
                TextEntry::make('password_hint')
                    ->label('Password hint')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

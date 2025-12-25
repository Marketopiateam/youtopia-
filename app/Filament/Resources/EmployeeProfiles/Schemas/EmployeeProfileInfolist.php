<?php

namespace App\Filament\Resources\EmployeeProfiles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EmployeeProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('employee.employee_code')
                    ->label('Employee')
                    ->placeholder('-'),
                TextEntry::make('full_name')
                    ->label('Name'),
                TextEntry::make('phone')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->placeholder('-'),
                TextEntry::make('national_id')
                    ->label('National ID')
                    ->placeholder('-'),
                TextEntry::make('birth_date')
                    ->label('Birth date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('address')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('emergency_contact_name')
                    ->label('Emergency contact name')
                    ->placeholder('-'),
                TextEntry::make('emergency_contact_phone')
                    ->label('Emergency contact phone')
                    ->placeholder('-'),
                TextEntry::make('avatar_path')
                    ->label('Avatar')
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

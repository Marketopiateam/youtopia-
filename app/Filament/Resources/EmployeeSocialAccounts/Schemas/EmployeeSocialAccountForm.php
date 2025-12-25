<?php

namespace App\Filament\Resources\EmployeeSocialAccounts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EmployeeSocialAccountForm
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
                TextInput::make('platform')
                    ->required()
                    ->maxLength(255),
                TextInput::make('username')
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('url')
                    ->url()
                    ->maxLength(255),
                TextInput::make('password_hint')
                    ->label('Password hint')
                    ->maxLength(255),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->default('active')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}

<?php

namespace App\Filament\Resources\EmployeeProfiles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EmployeeProfileForm
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
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('last_name')
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                TextInput::make('national_id')
                    ->label('National ID')
                    ->maxLength(255),
                DatePicker::make('birth_date')
                    ->label('Birth date'),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('emergency_contact_name')
                    ->label('Emergency contact name')
                    ->maxLength(255),
                TextInput::make('emergency_contact_phone')
                    ->label('Emergency contact phone')
                    ->tel()
                    ->maxLength(255),
                FileUpload::make('avatar_path')
                    ->label('Avatar')
                    ->image()
                    ->disk('public')
                    ->directory('employees/avatars')
                    ->preserveFilenames()
                    ->downloadable()
                    ->openable(),
            ]);
    }
}

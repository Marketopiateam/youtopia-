<?php

namespace App\Filament\Resources\LeaveRequests\Schemas;

use App\Enums\LeaveStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LeaveRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->relationship('employee', 'employee_code')
                    ->required()
                    ->searchable(),
                Select::make('leave_type_id')
                    ->relationship('leaveType', 'name')
                    ->required(),
                DatePicker::make('from_date')
                    ->required(),
                DatePicker::make('to_date')
                    ->required(),
                TextInput::make('days_count')
                    ->numeric()
                    ->required(),
                Textarea::make('reason')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(LeaveStatus::class)
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('submitted_at'),
            ]);
    }
}

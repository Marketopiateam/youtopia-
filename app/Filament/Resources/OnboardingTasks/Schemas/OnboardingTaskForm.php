<?php

namespace App\Filament\Resources\OnboardingTasks\Schemas;

use App\Enums\OnboardingTaskStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class OnboardingTaskForm
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
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('assigned_by_employee_id')
                    ->label('Assigned by')
                    ->relationship('assignedBy', 'employee_code')
                    ->searchable()
                    ->required(),
                DatePicker::make('due_date'),
                Select::make('status')
                    ->options(OnboardingTaskStatus::class)
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('completed_at'),
            ]);
    }
}

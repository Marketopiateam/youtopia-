<?php

namespace App\Filament\Resources\ApprovalRequests\Schemas;

use App\Enums\ApprovalStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ApprovalRequestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('workflow_id')
                    ->relationship('workflow', 'name')
                    ->required()
                    ->searchable(),
                TextInput::make('requestable_type')
                    ->required()
                    ->maxLength(255),
                TextInput::make('requestable_id')
                    ->required()
                    ->numeric(),
                Select::make('requester_employee_id')
                    ->relationship('requester', 'employee_code')
                    ->label('Requester')
                    ->required()
                    ->searchable(),
                TextInput::make('current_step')
                    ->numeric()
                    ->required(),
                Select::make('status')
                    ->options(ApprovalStatus::class)
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('submitted_at'),
                DateTimePicker::make('completed_at'),
            ]);
    }
}

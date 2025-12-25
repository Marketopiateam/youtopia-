<?php

namespace App\Filament\Resources\MeetingActionItems\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MeetingActionItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('meeting_id')
                    ->label('Meeting')
                    ->relationship('meeting', 'title')
                    ->searchable()
                    ->required(),
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('assigned_to_employee_id')
                    ->label('Assigned to')
                    ->relationship('assignedTo', 'employee_code')
                    ->searchable()
                    ->required(),
                DatePicker::make('due_date'),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}

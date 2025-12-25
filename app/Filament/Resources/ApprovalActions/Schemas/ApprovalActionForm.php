<?php

namespace App\Filament\Resources\ApprovalActions\Schemas;

use App\Enums\ApprovalActionType;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ApprovalActionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('approval_request_id')
                    ->relationship('approvalRequest', 'id')
                    ->required()
                    ->searchable(),
                Select::make('step_id')
                    ->relationship('step', 'step_order')
                    ->label('Step')
                    ->required()
                    ->searchable(),
                Select::make('approver_employee_id')
                    ->relationship('approver', 'employee_code')
                    ->label('Approver')
                    ->required()
                    ->searchable(),
                Select::make('action')
                    ->options(ApprovalActionType::class)
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                DateTimePicker::make('acted_at')
                    ->required(),
            ]);
    }
}

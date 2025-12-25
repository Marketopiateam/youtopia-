<?php

namespace App\Filament\Resources\ApprovalSteps\Schemas;

use App\Enums\ApprovalApproverType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ApprovalStepForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('workflow_id')
                    ->relationship('workflow', 'name')
                    ->required()
                    ->searchable(),
                TextInput::make('step_order')
                    ->numeric()
                    ->required(),
                Select::make('approver_type')
                    ->options(ApprovalApproverType::class)
                    ->default('employee')
                    ->required(),
                TextInput::make('approver_role')
                    ->maxLength(255),
                Select::make('approver_employee_id')
                    ->relationship('approver', 'employee_code')
                    ->label('Approver')
                    ->searchable(),
                Toggle::make('is_required')
                    ->required(),
            ]);
    }
}

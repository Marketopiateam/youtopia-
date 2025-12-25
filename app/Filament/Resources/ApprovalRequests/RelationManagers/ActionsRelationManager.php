<?php

namespace App\Filament\Resources\ApprovalRequests\RelationManagers;

use App\Enums\ApprovalActionType;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ActionsRelationManager extends RelationManager
{
    protected static string $relationship = 'actions';

    protected static ?string $title = 'Actions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('step.step_order')
                    ->label('Step')
                    ->sortable(),
                TextColumn::make('approver.employee_code')
                    ->label('Approver')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('action')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ApprovalActionType ? $state->value : (string) $state;

                        return Str::headline($value);
                    })
                    ->sortable(),
                TextColumn::make('acted_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}

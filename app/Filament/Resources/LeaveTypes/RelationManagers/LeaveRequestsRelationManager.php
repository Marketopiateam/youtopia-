<?php

namespace App\Filament\Resources\LeaveTypes\RelationManagers;

use App\Enums\LeaveStatus;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LeaveRequestsRelationManager extends RelationManager
{
    protected static string $relationship = 'requests';

    protected static ?string $title = 'Leave Requests';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                DatePicker::make('from_date')
                    ->required(),
                DatePicker::make('to_date')
                    ->required(),
                TextInput::make('days_count')
                    ->numeric()
                    ->required(),
                Textarea::make('reason')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(LeaveStatus::class)
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('submitted_at'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.employee_code')
                    ->label('Employee')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('from_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('to_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('days_count')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof LeaveStatus ? $state->value : (string) $state;

                        return LeaveStatus::tryFrom($value)?->label() ?? $value;
                    })
                    ->color(function ($state) {
                        $value = $state instanceof LeaveStatus ? $state->value : (string) $state;

                        return LeaveStatus::tryFrom($value)?->color() ?? 'gray';
                    })
                    ->sortable(),
                TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('-'),
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

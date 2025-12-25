<?php

namespace App\Filament\Resources\OkrKeyResults\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CheckinsRelationManager extends RelationManager
{
    protected static string $relationship = 'checkins';

    protected static ?string $title = 'Check-ins';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->relationship('employee', 'employee_code')
                    ->required()
                    ->searchable(),
                TextInput::make('value')
                    ->numeric()
                    ->required(),
                DateTimePicker::make('checked_in_at')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
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
                TextColumn::make('value')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('checked_in_at')
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

<?php

namespace App\Filament\Resources\Votes\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BallotsRelationManager extends RelationManager
{
    protected static string $relationship = 'ballots';

    protected static ?string $title = 'Ballots';

    public function form(Schema $schema): Schema
    {
        $vote = $this->getOwnerRecord();

        return $schema
            ->components([
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('option_id')
                    ->label('Option')
                    ->options(fn () => $vote->options()->orderBy('order')->pluck('option_text', 'id')->toArray())
                    ->searchable()
                    ->required(),
                DateTimePicker::make('voted_at')
                    ->required(),
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
                TextColumn::make('option.option_text')
                    ->label('Option')
                    ->searchable(),
                TextColumn::make('voted_at')
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

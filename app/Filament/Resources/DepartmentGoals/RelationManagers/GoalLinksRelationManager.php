<?php

namespace App\Filament\Resources\DepartmentGoals\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GoalLinksRelationManager extends RelationManager
{
    protected static string $relationship = 'goalLinks';

    protected static ?string $title = 'Linked objectives';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('goal_type')
                    ->default('department')
                    ->dehydrated(true),
                Select::make('objective_id')
                    ->relationship('objective', 'title')
                    ->required()
                    ->searchable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('objective.title')
                    ->label('Objective')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
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

<?php

namespace App\Filament\Resources\WorklifeComments\RelationManagers;

use App\Enums\ReactionType;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'reactions';

    protected static ?string $title = 'Reactions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'employee_code')
                    ->searchable()
                    ->required(),
                Select::make('reaction_type')
                    ->options(ReactionType::class)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.employee_code')
                    ->label('Employee')
                    ->searchable(),
                TextColumn::make('reaction_type')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ReactionType ? $state->value : (string) $state;

                        return ReactionType::tryFrom($value)?->name ?? $value;
                    }),
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

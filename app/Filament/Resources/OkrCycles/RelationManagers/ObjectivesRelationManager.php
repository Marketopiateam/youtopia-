<?php

namespace App\Filament\Resources\OkrCycles\RelationManagers;

use App\Enums\OKRScope;
use App\Enums\OKRStatus;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ObjectivesRelationManager extends RelationManager
{
    protected static string $relationship = 'objectives';

    protected static ?string $title = 'Objectives';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('scope')
                    ->options(OKRScope::class)
                    ->required(),
                TextInput::make('scope_id')
                    ->numeric(),
                Select::make('owner_employee_id')
                    ->relationship('owner', 'employee_code')
                    ->label('Owner')
                    ->searchable(),
                Select::make('parent_objective_id')
                    ->relationship('parent', 'title')
                    ->label('Parent objective')
                    ->searchable(),
                TextInput::make('progress_percentage')
                    ->numeric(),
                Select::make('status')
                    ->options(OKRStatus::class)
                    ->default('draft')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('owner.employee_code')
                    ->label('Owner')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof OKRStatus ? $state->value : (string) $state;

                        return OKRStatus::tryFrom($value)?->label() ?? $value;
                    })
                    ->color(function ($state) {
                        $value = $state instanceof OKRStatus ? $state->value : (string) $state;

                        return OKRStatus::tryFrom($value)?->color() ?? 'gray';
                    })
                    ->sortable(),
                TextColumn::make('progress_percentage')
                    ->numeric()
                    ->sortable()
                    ->label('Progress %'),
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

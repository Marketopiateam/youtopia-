<?php

namespace App\Filament\Resources\Employees\RelationManagers;

use App\Enums\ContractType;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContractsRelationManager extends RelationManager
{
    protected static string $relationship = 'contracts';
    protected static ?string $title = 'Contracts';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('contract_type')
                ->label('Contract Type')
                ->options([
                    ContractType::FullTime->value => 'Full Time',
                    ContractType::PartTime->value => 'Part Time',
                    ContractType::Contractor->value => 'Contractor',
                ])
                ->required(),

            DatePicker::make('start_date')->required(),
            DatePicker::make('end_date')->nullable(),

            DatePicker::make('probation_end_date')
                ->label('Probation End Date')
                ->nullable(),

            TextInput::make('working_hours_per_week')
                ->numeric()
                ->step('0.5')
                ->nullable(),

            TextInput::make('base_salary')
                ->numeric()
                ->required()
                ->default(0),

            KeyValue::make('terms')->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contract_type')->badge()->sortable(),
                TextColumn::make('start_date')->date()->sortable(),
                TextColumn::make('end_date')->date(),
                TextColumn::make('base_salary')->money('EGP')->sortable(),
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

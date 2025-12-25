<?php

namespace App\Filament\Resources\JobApplications\RelationManagers;

use App\Enums\OfferStatus;
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

class OfferLetterRelationManager extends RelationManager
{
    protected static string $relationship = 'offerLetter';

    protected static ?string $title = 'Offer letter';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('offered_position')
                    ->required()
                    ->maxLength(255),
                TextInput::make('salary_amount')
                    ->numeric()
                    ->required(),
                TextInput::make('currency_code')
                    ->maxLength(3)
                    ->default('USD')
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                Select::make('status')
                    ->options(OfferStatus::class)
                    ->default('draft')
                    ->required(),
                DateTimePicker::make('sent_at'),
                DateTimePicker::make('accepted_at'),
                Textarea::make('terms')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('offered_position')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('salary_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('currency_code')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof OfferStatus ? $state->value : (string) $state;

                        return OfferStatus::tryFrom($value)?->label() ?? $value;
                    })
                    ->color(function ($state) {
                        $value = $state instanceof OfferStatus ? $state->value : (string) $state;

                        return OfferStatus::tryFrom($value)?->color() ?? 'gray';
                    })
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('sent_at')
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

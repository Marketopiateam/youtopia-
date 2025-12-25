<?php

namespace App\Filament\Resources\PerformanceReviewTemplates\RelationManagers;

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
use Illuminate\Support\Str;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';

    protected static ?string $title = 'Questions';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('question_text')
                    ->required()
                    ->columnSpanFull(),
                Select::make('question_type')
                    ->options([
                        'text' => 'Text',
                        'rating' => 'Rating',
                        'multiple_choice' => 'Multiple choice',
                    ])
                    ->required(),
                TextInput::make('weight')
                    ->numeric()
                    ->default(1)
                    ->required(),
                TextInput::make('order')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question_text')
                    ->label('Question')
                    ->limit(60)
                    ->searchable(),
                TextColumn::make('question_type')
                    ->formatStateUsing(fn (?string $state) => $state ? Str::headline($state) : '-')
                    ->sortable(),
                TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('order')
                    ->numeric()
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

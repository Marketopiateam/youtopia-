<?php

namespace App\Filament\Resources\ReviewQuestions\RelationManagers;

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

class AnswersRelationManager extends RelationManager
{
    protected static string $relationship = 'answers';

    protected static ?string $title = 'Answers';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('review_id')
                    ->relationship('review', 'id')
                    ->label('Review')
                    ->required()
                    ->searchable(),
                Textarea::make('answer_text')
                    ->columnSpanFull(),
                TextInput::make('rating')
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('review.id')
                    ->label('Review')
                    ->sortable(),
                TextColumn::make('review.employee.employee_code')
                    ->label('Employee')
                    ->searchable(),
                TextColumn::make('rating')
                    ->numeric()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('answer_text')
                    ->limit(50)
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

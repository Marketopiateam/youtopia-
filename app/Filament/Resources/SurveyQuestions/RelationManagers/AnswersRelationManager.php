<?php

namespace App\Filament\Resources\SurveyQuestions\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
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
                Select::make('survey_response_id')
                    ->label('Response')
                    ->relationship('response', 'id')
                    ->searchable()
                    ->required(),
                Textarea::make('answer_text')
                    ->label('Answer text')
                    ->columnSpanFull(),
                Select::make('survey_question_option_id')
                    ->label('Selected option')
                    ->relationship('option', 'option_text')
                    ->searchable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('response.id')
                    ->label('Response')
                    ->sortable(),
                TextColumn::make('option.option_text')
                    ->label('Option')
                    ->placeholder('-'),
                TextColumn::make('answer_text')
                    ->label('Answer')
                    ->limit(60),
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

<?php

namespace App\Filament\Resources\JobApplications\RelationManagers;

use App\Enums\InterviewStatus;
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

class InterviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'interviews';

    protected static ?string $title = 'Interviews';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('scheduled_at')
                    ->required(),
                TextInput::make('location')
                    ->maxLength(255),
                Select::make('interview_type')
                    ->options([
                        'in_person' => 'In person',
                        'phone' => 'Phone',
                        'video' => 'Video',
                    ])
                    ->default('in_person')
                    ->required(),
                Select::make('status')
                    ->options(InterviewStatus::class)
                    ->default('scheduled')
                    ->required(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheduled_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('interview_type')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof InterviewStatus ? $state->value : (string) $state;

                        return InterviewStatus::tryFrom($value)?->label() ?? $value;
                    })
                    ->color(function ($state) {
                        $value = $state instanceof InterviewStatus ? $state->value : (string) $state;

                        return InterviewStatus::tryFrom($value)?->color() ?? 'gray';
                    })
                    ->sortable(),
                TextColumn::make('location')
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

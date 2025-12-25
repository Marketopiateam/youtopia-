<?php

namespace App\Filament\Resources\Interviews\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InterviewersRelationManager extends RelationManager
{
    protected static string $relationship = 'interviewers';

    protected static ?string $title = 'Interviewers';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('employee_code')
            ->columns([
                TextColumn::make('employee_code')
                    ->label('Interviewer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('pivot.rating')
                    ->numeric()
                    ->sortable()
                    ->placeholder('-'),
                TextColumn::make('pivot.feedback')
                    ->label('Feedback')
                    ->limit(40)
                    ->placeholder('-'),
            ])
            ->headerActions([
                AttachAction::make()
                    ->recordSelectSearchColumns(['employee_code'])
                    ->preloadRecordSelect()
                    ->schema(fn (AttachAction $action): array => [
                        $action->getRecordSelect(),
                        TextInput::make('rating')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10),
                        Textarea::make('feedback')
                            ->columnSpanFull(),
                    ]),
            ])
            ->actions([
                DetachAction::make(),
            ])
            ->toolbarActions([
                DetachBulkAction::make(),
            ]);
    }
}

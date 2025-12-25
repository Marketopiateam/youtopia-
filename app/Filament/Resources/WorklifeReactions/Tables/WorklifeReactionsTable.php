<?php

namespace App\Filament\Resources\WorklifeReactions\Tables;

use App\Enums\ReactionType;
use App\Models\WorklifeComment;
use App\Models\WorklifePost;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class WorklifeReactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reactable_type')
                    ->label('Reactable type')
                    ->badge(),
                TextColumn::make('reactable_id')
                    ->label('Reactable ID')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('employee.employee_code')
                    ->label('Employee')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reaction_type')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ReactionType ? $state->value : (string) $state;

                        return ReactionType::tryFrom($value)?->name ?? $value;
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('reactable_type')
                    ->label('Reactable type')
                    ->options([
                        WorklifePost::class => 'Worklife Post',
                        WorklifeComment::class => 'Worklife Comment',
                    ]),
                SelectFilter::make('reaction_type')
                    ->options(ReactionType::class),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

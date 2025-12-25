<?php

namespace App\Filament\Resources\ApprovalRequests\Tables;

use App\Enums\ApprovalStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ApprovalRequestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('workflow.name')
                    ->label('Workflow')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('requestable_type')
                    ->label('Requestable type')
                    ->searchable(),
                TextColumn::make('requestable_id')
                    ->label('Requestable ID')
                    ->sortable(),
                TextColumn::make('requester.employee_code')
                    ->label('Requester')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('current_step')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ApprovalStatus ? $state->value : (string) $state;

                        return ApprovalStatus::tryFrom($value)?->label() ?? $value;
                    })
                    ->color(function ($state) {
                        $value = $state instanceof ApprovalStatus ? $state->value : (string) $state;

                        return ApprovalStatus::tryFrom($value)?->color() ?? 'gray';
                    })
                    ->sortable(),
                TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('completed_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(ApprovalStatus::class),
                SelectFilter::make('workflow_id')
                    ->relationship('workflow', 'name')
                    ->label('Workflow'),
                SelectFilter::make('requester_employee_id')
                    ->relationship('requester', 'employee_code')
                    ->label('Requester'),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}

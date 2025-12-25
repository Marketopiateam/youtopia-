<?php

namespace App\Filament\Resources\ApprovalSteps\Tables;

use App\Enums\ApprovalApproverType;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ApprovalStepsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('workflow.name')
                    ->label('Workflow')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('step_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('approver_type')
                    ->formatStateUsing(function ($state) {
                        $value = $state instanceof ApprovalApproverType ? $state->value : (string) $state;

                        return Str::headline($value);
                    })
                    ->sortable(),
                TextColumn::make('approver_role')
                    ->searchable()
                    ->placeholder('-'),
                TextColumn::make('approver.employee_code')
                    ->label('Approver')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('is_required')
                    ->boolean(),
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
                SelectFilter::make('workflow_id')
                    ->relationship('workflow', 'name')
                    ->label('Workflow'),
                SelectFilter::make('approver_type')
                    ->options(ApprovalApproverType::class),
                TernaryFilter::make('is_required'),
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

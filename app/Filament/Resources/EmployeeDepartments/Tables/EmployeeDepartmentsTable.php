<?php

namespace App\Filament\Resources\EmployeeDepartments\Tables;

use App\Models\Department;
use App\Models\Employee;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeeDepartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee_id')
                    ->label('Employee')
                    ->formatStateUsing(fn ($state) => Employee::query()->whereKey($state)->value('employee_code') ?? $state)
                    ->sortable(),
                TextColumn::make('department_id')
                    ->label('Department')
                    ->formatStateUsing(fn ($state) => Department::query()->whereKey($state)->value('name') ?? $state)
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->placeholder('-'),
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
                SelectFilter::make('employee_id')
                    ->label('Employee')
                    ->options(fn () => Employee::query()
                        ->orderBy('employee_code')
                        ->pluck('employee_code', 'id')
                        ->toArray()),
                SelectFilter::make('department_id')
                    ->label('Department')
                    ->options(fn () => Department::query()
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->toArray()),
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

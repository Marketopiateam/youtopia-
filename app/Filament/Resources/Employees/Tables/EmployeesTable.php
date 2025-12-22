<?php

namespace App\Filament\Resources\Employees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // 🖼️ صورة الموظف
                ImageColumn::make('profile.avatar_path')
                    ->label('Photo')
                    ->disk('public')
                    ->circular()
                    ->height(48)
                    ->width(48),

                TextColumn::make('employee_code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('profile.full_name')
                    ->label('Name')
                    ->searchable(),

                TextColumn::make('department.name')
                    ->label('Department')
                    ->sortable(),

                TextColumn::make('manager.profile.full_name')
                    ->label('Manager')
                    ->formatStateUsing(function ($state, $record) {
                        if ($record->manager && $record->manager->profile) {
                            $fullName = trim(($record->manager->profile->first_name ?? '') . ' ' . ($record->manager->profile->last_name ?? ''));
                            return $record->manager->employee_code . ' - ' . ($fullName ?: '-');
                        }
                        return '-';
                    })
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('hire_date')
                    ->date()
                    ->sortable()
                    ->toggleable()
                    ->since(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
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

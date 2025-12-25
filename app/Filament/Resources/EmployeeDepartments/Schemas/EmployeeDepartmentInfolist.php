<?php

namespace App\Filament\Resources\EmployeeDepartments\Schemas;

use App\Models\Department;
use App\Models\Employee;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EmployeeDepartmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('employee_id')
                    ->label('Employee')
                    ->formatStateUsing(fn ($state) => Employee::query()->whereKey($state)->value('employee_code') ?? $state),
                TextEntry::make('department_id')
                    ->label('Department')
                    ->formatStateUsing(fn ($state) => Department::query()->whereKey($state)->value('name') ?? $state),
                TextEntry::make('start_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('end_date')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

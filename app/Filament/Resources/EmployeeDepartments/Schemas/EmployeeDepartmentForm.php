<?php

namespace App\Filament\Resources\EmployeeDepartments\Schemas;

use App\Models\Department;
use App\Models\Employee;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class EmployeeDepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->label('Employee')
                    ->options(fn () => Employee::query()
                        ->orderBy('employee_code')
                        ->pluck('employee_code', 'id')
                        ->toArray())
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('department_id')
                    ->label('Department')
                    ->options(fn () => Department::query()
                        ->orderBy('name')
                        ->pluck('name', 'id')
                        ->toArray())
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('start_date')
                    ->required(),
                DatePicker::make('end_date'),
            ]);
    }
}

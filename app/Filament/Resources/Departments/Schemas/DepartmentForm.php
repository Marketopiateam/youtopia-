<?php

namespace App\Filament\Resources\Departments\Schemas;

use App\Models\Department;
use App\Models\Employee;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            TextInput::make('name')->required()->maxLength(255),

            TextInput::make('code')->maxLength(50),

            Select::make('parent_id')
                ->label('Parent Department')
                ->options(fn() => Department::query()->orderBy('name')->pluck('name', 'id')->toArray())
                ->searchable()
                ->preload()
                ->nullable(),

            Select::make('manager_employee_id')
                ->label('Manager')
                ->options(fn() => Employee::query()->orderBy('employee_code')->pluck('employee_code', 'id')->toArray())
                ->searchable()
                ->preload()
                ->nullable(),

            Toggle::make('is_active')->default(true),
            ]);
    }
}

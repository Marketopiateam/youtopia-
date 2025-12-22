<?php

namespace App\Filament\Resources\Employees\Schemas;

use App\Enums\EmployeeStatus;
use App\Models\Department;
use App\Models\Employee;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Employee')
                    ->tabs([

                        /* =======================
                         | Core
                         =======================*/
                        Tabs\Tab::make('Core')->schema([
                            Section::make('Employee')
                                ->columns(3)
                                ->schema([
                                    TextInput::make('employee_code')
                                        ->disabled()
                                        ->dehydrated(false)
                                        ->helperText('Auto generated'),

                                    Select::make('status')
                                        ->options([
                                            EmployeeStatus::Active->value => 'Active',
                                            EmployeeStatus::Terminated->value => 'Terminated',
                                        ])
                                        ->required()
                                        ->default(EmployeeStatus::Active->value),

                                    Select::make('department_id')
                                        ->label('Department')
                                        ->options(
                                            fn() => Department::query()
                                                ->orderBy('name')
                                                ->pluck('name', 'id')
                                                ->toArray()
                                        )
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),

                                    Select::make('manager_employee_id')
                                        ->label('Manager')
                                        ->options(
                                            fn() => Employee::query()
                                                ->with('profile')
                                                ->orderBy('employee_code')
                                                ->get()
                                                ->mapWithKeys(function ($employee) {
                                                    $fullName = trim(($employee->profile?->first_name ?? '') . ' ' . ($employee->profile?->last_name ?? ''));
                                                    return [$employee->id => $fullName];
                                                })
                                                ->toArray()
                                        )
                                        ->searchable()
                                        ->preload()
                                        ->nullable(),

                                    DatePicker::make('hire_date')->nullable(),
                                    DatePicker::make('termination_date')->nullable(),
                                ]),
                        ]),

                        /* =======================
                         | Profile
                         =======================*/
                        Tabs\Tab::make('Profile')->schema([
                            Section::make('Profile')
                                ->relationship('profile') // 🔥 المهم
                                ->columns(2)
                                ->schema([

                                    /* 🖼️ Employee Photo */
                                    FileUpload::make('avatar_path')
                                        ->label('Employee Photo')
                                        ->image()
                                        ->imageEditor()
                                        ->imageCropAspectRatio('1:1')
                                        ->imageResizeTargetWidth(800)
                                        ->imageResizeTargetHeight(800)
                                        ->directory('employees/avatars')
                                        ->disk('public')
                                        ->visibility('public')
                                        ->columnSpanFull(),

                                    TextInput::make('first_name')->required(),
                                    TextInput::make('last_name')->required(),

                                    TextInput::make('phone')->tel(),
                                    TextInput::make('email')->email(),

                                    TextInput::make('national_id'),

                                    DatePicker::make('birth_date')->nullable(),

                                    TextInput::make('address')
                                        ->columnSpanFull(),

                                    TextInput::make('emergency_contact_name'),
                                    TextInput::make('emergency_contact_phone')->tel(),
                                ]),
                        ]),

                        // Contracts & Documents في Relation Managers (صح 👌)
                    ]),
            ]);
    }
}

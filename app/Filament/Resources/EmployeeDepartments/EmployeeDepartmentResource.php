<?php

namespace App\Filament\Resources\EmployeeDepartments;

use App\Filament\Resources\EmployeeDepartments\Pages\CreateEmployeeDepartment;
use App\Filament\Resources\EmployeeDepartments\Pages\EditEmployeeDepartment;
use App\Filament\Resources\EmployeeDepartments\Pages\ListEmployeeDepartments;
use App\Filament\Resources\EmployeeDepartments\Pages\ViewEmployeeDepartment;
use App\Filament\Resources\EmployeeDepartments\Schemas\EmployeeDepartmentForm;
use App\Filament\Resources\EmployeeDepartments\Schemas\EmployeeDepartmentInfolist;
use App\Filament\Resources\EmployeeDepartments\Tables\EmployeeDepartmentsTable;
use App\Models\EmployeeDepartment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class EmployeeDepartmentResource extends Resource
{
    protected static ?string $model = EmployeeDepartment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Onboarding';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return EmployeeDepartmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EmployeeDepartmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmployeeDepartmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEmployeeDepartments::route('/'),
            'create' => CreateEmployeeDepartment::route('/create'),
            'view' => ViewEmployeeDepartment::route('/{record}'),
            'edit' => EditEmployeeDepartment::route('/{record}/edit'),
        ];
    }
}

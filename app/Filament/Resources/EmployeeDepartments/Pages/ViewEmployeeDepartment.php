<?php

namespace App\Filament\Resources\EmployeeDepartments\Pages;

use App\Filament\Resources\EmployeeDepartments\EmployeeDepartmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployeeDepartment extends ViewRecord
{
    protected static string $resource = EmployeeDepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

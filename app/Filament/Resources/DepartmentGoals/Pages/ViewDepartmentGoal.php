<?php

namespace App\Filament\Resources\DepartmentGoals\Pages;

use App\Filament\Resources\DepartmentGoals\DepartmentGoalResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDepartmentGoal extends ViewRecord
{
    protected static string $resource = DepartmentGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

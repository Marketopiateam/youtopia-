<?php

namespace App\Filament\Resources\DepartmentGoals\Pages;

use App\Filament\Resources\DepartmentGoals\DepartmentGoalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDepartmentGoal extends EditRecord
{
    protected static string $resource = DepartmentGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

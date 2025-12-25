<?php

namespace App\Filament\Resources\DepartmentGoals\Pages;

use App\Filament\Resources\DepartmentGoals\DepartmentGoalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDepartmentGoals extends ListRecords
{
    protected static string $resource = DepartmentGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

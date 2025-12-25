<?php

namespace App\Filament\Resources\CompanyGoals\Pages;

use App\Filament\Resources\CompanyGoals\CompanyGoalResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyGoal extends ViewRecord
{
    protected static string $resource = CompanyGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

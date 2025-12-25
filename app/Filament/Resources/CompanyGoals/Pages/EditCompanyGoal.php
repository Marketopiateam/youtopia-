<?php

namespace App\Filament\Resources\CompanyGoals\Pages;

use App\Filament\Resources\CompanyGoals\CompanyGoalResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCompanyGoal extends EditRecord
{
    protected static string $resource = CompanyGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

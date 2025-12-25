<?php

namespace App\Filament\Resources\CompanyGoals\Pages;

use App\Filament\Resources\CompanyGoals\CompanyGoalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompanyGoals extends ListRecords
{
    protected static string $resource = CompanyGoalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

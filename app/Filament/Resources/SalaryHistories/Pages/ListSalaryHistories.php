<?php

namespace App\Filament\Resources\SalaryHistories\Pages;

use App\Filament\Resources\SalaryHistories\SalaryHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSalaryHistories extends ListRecords
{
    protected static string $resource = SalaryHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

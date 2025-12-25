<?php

namespace App\Filament\Resources\SalaryHistories\Pages;

use App\Filament\Resources\SalaryHistories\SalaryHistoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSalaryHistory extends ViewRecord
{
    protected static string $resource = SalaryHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

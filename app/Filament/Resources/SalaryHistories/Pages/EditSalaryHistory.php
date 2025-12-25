<?php

namespace App\Filament\Resources\SalaryHistories\Pages;

use App\Filament\Resources\SalaryHistories\SalaryHistoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSalaryHistory extends EditRecord
{
    protected static string $resource = SalaryHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

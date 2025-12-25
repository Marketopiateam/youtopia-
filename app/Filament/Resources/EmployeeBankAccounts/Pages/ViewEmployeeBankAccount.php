<?php

namespace App\Filament\Resources\EmployeeBankAccounts\Pages;

use App\Filament\Resources\EmployeeBankAccounts\EmployeeBankAccountResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployeeBankAccount extends ViewRecord
{
    protected static string $resource = EmployeeBankAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

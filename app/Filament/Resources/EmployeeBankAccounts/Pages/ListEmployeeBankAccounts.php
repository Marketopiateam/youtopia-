<?php

namespace App\Filament\Resources\EmployeeBankAccounts\Pages;

use App\Filament\Resources\EmployeeBankAccounts\EmployeeBankAccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeBankAccounts extends ListRecords
{
    protected static string $resource = EmployeeBankAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

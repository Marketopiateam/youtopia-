<?php

namespace App\Filament\Resources\EmployeeBankAccounts\Pages;

use App\Filament\Resources\EmployeeBankAccounts\EmployeeBankAccountResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeBankAccount extends EditRecord
{
    protected static string $resource = EmployeeBankAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

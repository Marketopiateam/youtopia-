<?php

namespace App\Filament\Resources\EmployeeSocialAccounts\Pages;

use App\Filament\Resources\EmployeeSocialAccounts\EmployeeSocialAccountResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEmployeeSocialAccount extends EditRecord
{
    protected static string $resource = EmployeeSocialAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\EmployeeSocialAccounts\Pages;

use App\Filament\Resources\EmployeeSocialAccounts\EmployeeSocialAccountResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployeeSocialAccount extends ViewRecord
{
    protected static string $resource = EmployeeSocialAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

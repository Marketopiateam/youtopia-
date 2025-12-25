<?php

namespace App\Filament\Resources\EmployeeSocialAccounts\Pages;

use App\Filament\Resources\EmployeeSocialAccounts\EmployeeSocialAccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmployeeSocialAccounts extends ListRecords
{
    protected static string $resource = EmployeeSocialAccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

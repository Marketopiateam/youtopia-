<?php

namespace App\Filament\Resources\AllowanceTypes\Pages;

use App\Filament\Resources\AllowanceTypes\AllowanceTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAllowanceType extends ViewRecord
{
    protected static string $resource = AllowanceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\DeductionTypes\Pages;

use App\Filament\Resources\DeductionTypes\DeductionTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDeductionType extends ViewRecord
{
    protected static string $resource = DeductionTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

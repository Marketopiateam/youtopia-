<?php

namespace App\Filament\Resources\OkrCycles\Pages;

use App\Filament\Resources\OkrCycles\OkrCycleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOkrCycle extends ViewRecord
{
    protected static string $resource = OkrCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

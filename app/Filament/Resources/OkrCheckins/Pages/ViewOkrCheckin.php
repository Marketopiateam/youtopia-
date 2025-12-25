<?php

namespace App\Filament\Resources\OkrCheckins\Pages;

use App\Filament\Resources\OkrCheckins\OkrCheckinResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOkrCheckin extends ViewRecord
{
    protected static string $resource = OkrCheckinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

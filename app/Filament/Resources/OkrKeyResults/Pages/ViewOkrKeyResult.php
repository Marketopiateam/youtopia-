<?php

namespace App\Filament\Resources\OkrKeyResults\Pages;

use App\Filament\Resources\OkrKeyResults\OkrKeyResultResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOkrKeyResult extends ViewRecord
{
    protected static string $resource = OkrKeyResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

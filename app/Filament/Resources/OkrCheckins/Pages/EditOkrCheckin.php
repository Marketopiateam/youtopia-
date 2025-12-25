<?php

namespace App\Filament\Resources\OkrCheckins\Pages;

use App\Filament\Resources\OkrCheckins\OkrCheckinResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOkrCheckin extends EditRecord
{
    protected static string $resource = OkrCheckinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

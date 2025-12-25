<?php

namespace App\Filament\Resources\OkrCycles\Pages;

use App\Filament\Resources\OkrCycles\OkrCycleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOkrCycle extends EditRecord
{
    protected static string $resource = OkrCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

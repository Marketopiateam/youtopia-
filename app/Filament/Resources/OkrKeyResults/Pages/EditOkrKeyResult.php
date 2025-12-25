<?php

namespace App\Filament\Resources\OkrKeyResults\Pages;

use App\Filament\Resources\OkrKeyResults\OkrKeyResultResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOkrKeyResult extends EditRecord
{
    protected static string $resource = OkrKeyResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

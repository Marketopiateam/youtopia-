<?php

namespace App\Filament\Resources\OkrCycles\Pages;

use App\Filament\Resources\OkrCycles\OkrCycleResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOkrCycles extends ListRecords
{
    protected static string $resource = OkrCycleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

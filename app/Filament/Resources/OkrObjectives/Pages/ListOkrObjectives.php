<?php

namespace App\Filament\Resources\OkrObjectives\Pages;

use App\Filament\Resources\OkrObjectives\OkrObjectiveResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOkrObjectives extends ListRecords
{
    protected static string $resource = OkrObjectiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

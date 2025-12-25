<?php

namespace App\Filament\Resources\WorklifeGroups\Pages;

use App\Filament\Resources\WorklifeGroups\WorklifeGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorklifeGroups extends ListRecords
{
    protected static string $resource = WorklifeGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\WorklifeGroups\Pages;

use App\Filament\Resources\WorklifeGroups\WorklifeGroupResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorklifeGroup extends ViewRecord
{
    protected static string $resource = WorklifeGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

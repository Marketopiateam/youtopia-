<?php

namespace App\Filament\Resources\WorklifeLikes\Pages;

use App\Filament\Resources\WorklifeLikes\WorklifeLikeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorklifeLike extends ViewRecord
{
    protected static string $resource = WorklifeLikeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

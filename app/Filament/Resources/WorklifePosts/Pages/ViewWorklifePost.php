<?php

namespace App\Filament\Resources\WorklifePosts\Pages;

use App\Filament\Resources\WorklifePosts\WorklifePostResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorklifePost extends ViewRecord
{
    protected static string $resource = WorklifePostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

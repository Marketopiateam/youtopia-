<?php

namespace App\Filament\Resources\WorklifeLikes\Pages;

use App\Filament\Resources\WorklifeLikes\WorklifeLikeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorklifeLikes extends ListRecords
{
    protected static string $resource = WorklifeLikeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

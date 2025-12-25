<?php

namespace App\Filament\Resources\OkrCheckins\Pages;

use App\Filament\Resources\OkrCheckins\OkrCheckinResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOkrCheckins extends ListRecords
{
    protected static string $resource = OkrCheckinResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

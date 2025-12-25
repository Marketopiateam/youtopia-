<?php

namespace App\Filament\Resources\OkrKeyResults\Pages;

use App\Filament\Resources\OkrKeyResults\OkrKeyResultResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOkrKeyResults extends ListRecords
{
    protected static string $resource = OkrKeyResultResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

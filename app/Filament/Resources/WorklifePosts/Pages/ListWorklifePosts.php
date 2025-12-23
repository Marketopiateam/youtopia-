<?php

namespace App\Filament\Resources\WorklifePosts\Pages;

use App\Filament\Resources\WorklifePosts\WorklifePostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorklifePosts extends ListRecords
{
    protected static string $resource = WorklifePostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

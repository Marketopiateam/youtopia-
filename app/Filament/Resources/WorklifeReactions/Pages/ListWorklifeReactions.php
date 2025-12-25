<?php

namespace App\Filament\Resources\WorklifeReactions\Pages;

use App\Filament\Resources\WorklifeReactions\WorklifeReactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWorklifeReactions extends ListRecords
{
    protected static string $resource = WorklifeReactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

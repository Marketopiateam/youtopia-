<?php

namespace App\Filament\Resources\GoalLinks\Pages;

use App\Filament\Resources\GoalLinks\GoalLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGoalLinks extends ListRecords
{
    protected static string $resource = GoalLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

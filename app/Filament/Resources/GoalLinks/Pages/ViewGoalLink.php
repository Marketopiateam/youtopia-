<?php

namespace App\Filament\Resources\GoalLinks\Pages;

use App\Filament\Resources\GoalLinks\GoalLinkResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGoalLink extends ViewRecord
{
    protected static string $resource = GoalLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

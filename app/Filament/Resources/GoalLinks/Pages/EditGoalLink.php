<?php

namespace App\Filament\Resources\GoalLinks\Pages;

use App\Filament\Resources\GoalLinks\GoalLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGoalLink extends EditRecord
{
    protected static string $resource = GoalLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

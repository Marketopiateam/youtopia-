<?php

namespace App\Filament\Resources\WorklifeReactions\Pages;

use App\Filament\Resources\WorklifeReactions\WorklifeReactionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorklifeReaction extends ViewRecord
{
    protected static string $resource = WorklifeReactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

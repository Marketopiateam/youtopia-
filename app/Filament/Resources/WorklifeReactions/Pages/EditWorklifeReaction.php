<?php

namespace App\Filament\Resources\WorklifeReactions\Pages;

use App\Filament\Resources\WorklifeReactions\WorklifeReactionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWorklifeReaction extends EditRecord
{
    protected static string $resource = WorklifeReactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

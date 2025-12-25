<?php

namespace App\Filament\Resources\VoteOptions\Pages;

use App\Filament\Resources\VoteOptions\VoteOptionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVoteOption extends ViewRecord
{
    protected static string $resource = VoteOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

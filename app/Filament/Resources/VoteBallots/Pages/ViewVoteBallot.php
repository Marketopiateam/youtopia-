<?php

namespace App\Filament\Resources\VoteBallots\Pages;

use App\Filament\Resources\VoteBallots\VoteBallotResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVoteBallot extends ViewRecord
{
    protected static string $resource = VoteBallotResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

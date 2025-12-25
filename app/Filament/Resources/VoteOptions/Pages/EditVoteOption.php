<?php

namespace App\Filament\Resources\VoteOptions\Pages;

use App\Filament\Resources\VoteOptions\VoteOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditVoteOption extends EditRecord
{
    protected static string $resource = VoteOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

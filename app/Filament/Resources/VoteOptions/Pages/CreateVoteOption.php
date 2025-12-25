<?php

namespace App\Filament\Resources\VoteOptions\Pages;

use App\Filament\Resources\VoteOptions\VoteOptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVoteOption extends CreateRecord
{
    protected static string $resource = VoteOptionResource::class;
}

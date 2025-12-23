<?php

namespace App\Filament\Resources\WorklifePosts\Pages;

use App\Filament\Resources\WorklifePosts\WorklifePostResource;
use Filament\Resources\Pages\CreateRecord;

class CreateWorklifePost extends CreateRecord
{
    protected static string $resource = WorklifePostResource::class;
}

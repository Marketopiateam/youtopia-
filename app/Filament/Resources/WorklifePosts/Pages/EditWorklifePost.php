<?php

namespace App\Filament\Resources\WorklifePosts\Pages;

use App\Filament\Resources\WorklifePosts\WorklifePostResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWorklifePost extends EditRecord
{
    protected static string $resource = WorklifePostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}

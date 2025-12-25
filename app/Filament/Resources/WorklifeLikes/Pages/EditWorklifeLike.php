<?php

namespace App\Filament\Resources\WorklifeLikes\Pages;

use App\Filament\Resources\WorklifeLikes\WorklifeLikeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWorklifeLike extends EditRecord
{
    protected static string $resource = WorklifeLikeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

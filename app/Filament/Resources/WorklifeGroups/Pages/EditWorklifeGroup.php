<?php

namespace App\Filament\Resources\WorklifeGroups\Pages;

use App\Filament\Resources\WorklifeGroups\WorklifeGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWorklifeGroup extends EditRecord
{
    protected static string $resource = WorklifeGroupResource::class;

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

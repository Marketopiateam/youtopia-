<?php

namespace App\Filament\Resources\WorklifeComments\Pages;

use App\Filament\Resources\WorklifeComments\WorklifeCommentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWorklifeComment extends ViewRecord
{
    protected static string $resource = WorklifeCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

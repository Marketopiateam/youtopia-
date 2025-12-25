<?php

namespace App\Filament\Resources\ApprovalActions\Pages;

use App\Filament\Resources\ApprovalActions\ApprovalActionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewApprovalAction extends ViewRecord
{
    protected static string $resource = ApprovalActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

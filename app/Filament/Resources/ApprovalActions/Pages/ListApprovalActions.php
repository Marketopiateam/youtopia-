<?php

namespace App\Filament\Resources\ApprovalActions\Pages;

use App\Filament\Resources\ApprovalActions\ApprovalActionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApprovalActions extends ListRecords
{
    protected static string $resource = ApprovalActionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ApprovalSteps\Pages;

use App\Filament\Resources\ApprovalSteps\ApprovalStepResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApprovalSteps extends ListRecords
{
    protected static string $resource = ApprovalStepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

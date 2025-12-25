<?php

namespace App\Filament\Resources\PerformanceReviewTemplates\Pages;

use App\Filament\Resources\PerformanceReviewTemplates\PerformanceReviewTemplateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerformanceReviewTemplate extends EditRecord
{
    protected static string $resource = PerformanceReviewTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

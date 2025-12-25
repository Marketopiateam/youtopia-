<?php

namespace App\Filament\Resources\PerformanceReviewTemplates\Pages;

use App\Filament\Resources\PerformanceReviewTemplates\PerformanceReviewTemplateResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPerformanceReviewTemplate extends ViewRecord
{
    protected static string $resource = PerformanceReviewTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\PerformanceReviewTemplates\Pages;

use App\Filament\Resources\PerformanceReviewTemplates\PerformanceReviewTemplateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPerformanceReviewTemplates extends ListRecords
{
    protected static string $resource = PerformanceReviewTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

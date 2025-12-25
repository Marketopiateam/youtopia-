<?php

namespace App\Filament\Resources\OnboardingTasks\Pages;

use App\Filament\Resources\OnboardingTasks\OnboardingTaskResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOnboardingTasks extends ListRecords
{
    protected static string $resource = OnboardingTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

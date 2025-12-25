<?php

namespace App\Filament\Resources\OnboardingTasks\Pages;

use App\Filament\Resources\OnboardingTasks\OnboardingTaskResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOnboardingTask extends ViewRecord
{
    protected static string $resource = OnboardingTaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

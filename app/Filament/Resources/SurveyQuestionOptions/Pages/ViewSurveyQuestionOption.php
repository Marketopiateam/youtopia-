<?php

namespace App\Filament\Resources\SurveyQuestionOptions\Pages;

use App\Filament\Resources\SurveyQuestionOptions\SurveyQuestionOptionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSurveyQuestionOption extends ViewRecord
{
    protected static string $resource = SurveyQuestionOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\SurveyQuestionOptions\Pages;

use App\Filament\Resources\SurveyQuestionOptions\SurveyQuestionOptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSurveyQuestionOptions extends ListRecords
{
    protected static string $resource = SurveyQuestionOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

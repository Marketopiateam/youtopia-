<?php

namespace App\Filament\Resources\SurveyQuestionOptions\Pages;

use App\Filament\Resources\SurveyQuestionOptions\SurveyQuestionOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSurveyQuestionOption extends EditRecord
{
    protected static string $resource = SurveyQuestionOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ReviewAnswers\Pages;

use App\Filament\Resources\ReviewAnswers\ReviewAnswerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReviewAnswer extends ViewRecord
{
    protected static string $resource = ReviewAnswerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\ReviewQuestions\Pages;

use App\Filament\Resources\ReviewQuestions\ReviewQuestionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReviewQuestion extends CreateRecord
{
    protected static string $resource = ReviewQuestionResource::class;
}

<?php

namespace App\Repositories;

use App\Models\Survey;

class SurveyRepository extends BaseRepository
{
    protected function model(): string
    {
        return Survey::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\OkrObjective;

class OkrObjectiveRepository extends BaseRepository
{
    protected function model(): string
    {
        return OkrObjective::class;
    }
}

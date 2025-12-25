<?php

namespace App\Repositories;

use App\Models\PerformanceReview;

class PerformanceReviewRepository extends BaseRepository
{
    protected function model(): string
    {
        return PerformanceReview::class;
    }
}

<?php

namespace App\Repositories;

use App\Models\WorklifePost;

class WorklifePostRepository extends BaseRepository
{
    protected function model(): string
    {
        return WorklifePost::class;
    }
}

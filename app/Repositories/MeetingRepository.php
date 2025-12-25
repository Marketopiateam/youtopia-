<?php

namespace App\Repositories;

use App\Models\Meeting;

class MeetingRepository extends BaseRepository
{
    protected function model(): string
    {
        return Meeting::class;
    }
}

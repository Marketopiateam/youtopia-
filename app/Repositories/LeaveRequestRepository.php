<?php

namespace App\Repositories;

use App\Models\LeaveRequest;

class LeaveRequestRepository extends BaseRepository
{
    protected function model(): string
    {
        return LeaveRequest::class;
    }
}

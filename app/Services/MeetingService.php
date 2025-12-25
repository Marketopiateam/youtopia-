<?php

namespace App\Services;

use App\Repositories\MeetingRepository;

class MeetingService extends BaseService
{
    public function __construct(MeetingRepository $repository)
    {
        parent::__construct($repository);
    }
}

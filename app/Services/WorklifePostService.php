<?php

namespace App\Services;

use App\Repositories\WorklifePostRepository;

class WorklifePostService extends BaseService
{
    public function __construct(WorklifePostRepository $repository)
    {
        parent::__construct($repository);
    }
}

<?php

namespace App\Services;

use App\Repositories\OkrObjectiveRepository;

class OkrObjectiveService extends BaseService
{
    public function __construct(OkrObjectiveRepository $repository)
    {
        parent::__construct($repository);
    }
}

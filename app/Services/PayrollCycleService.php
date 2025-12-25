<?php

namespace App\Services;

use App\Repositories\PayrollCycleRepository;

class PayrollCycleService extends BaseService
{
    public function __construct(PayrollCycleRepository $repository)
    {
        parent::__construct($repository);
    }
}

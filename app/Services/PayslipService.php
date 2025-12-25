<?php

namespace App\Services;

use App\Repositories\PayslipRepository;

class PayslipService extends BaseService
{
    public function __construct(PayslipRepository $repository)
    {
        parent::__construct($repository);
    }
}

<?php

namespace App\Repositories;

use App\Models\PayrollCycle;

class PayrollCycleRepository extends BaseRepository
{
    protected function model(): string
    {
        return PayrollCycle::class;
    }
}

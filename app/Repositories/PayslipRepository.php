<?php

namespace App\Repositories;

use App\Models\Payslip;

class PayslipRepository extends BaseRepository
{
    protected function model(): string
    {
        return Payslip::class;
    }
}

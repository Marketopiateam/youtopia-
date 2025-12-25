<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository extends BaseRepository
{
    protected function model(): string
    {
        return Employee::class;
    }
}

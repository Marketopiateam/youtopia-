<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDepartment extends Model
{
    protected $fillable = [
        'employee_id',
        'department_id',
        'start_date',
        'end_date',
    ];
}

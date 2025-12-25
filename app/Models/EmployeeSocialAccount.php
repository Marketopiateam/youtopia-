<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSocialAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'platform',
        'username',
        'email',
        'url',
        'password_hint',
        'notes',
        'status',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

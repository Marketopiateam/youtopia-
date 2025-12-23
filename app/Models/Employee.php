<?php

namespace App\Models;

use App\Enums\EmployeeStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'employee_number',
        'employee_code',
        'status',
        'hire_date',
        'termination_date',
        'department_id',
        'manager_employee_id',
    ];

    protected $casts = [
        'status' => EmployeeStatus::class,
        'hire_date' => 'date',
        'termination_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (Employee $employee) {
            // Serial number
            if (! $employee->employee_number) {
                $max = (int) (self::withTrashed()->max('employee_number') ?? 0);
                $employee->employee_number = $max + 1;
            }

            // EMP-000001
            if (! $employee->employee_code) {
                $employee->employee_code = 'EMP-' . str_pad((string) $employee->employee_number, 6, '0', STR_PAD_LEFT);
            }

            if (! $employee->status) {
                $employee->status = EmployeeStatus::Active;
            }
        });
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(self::class, 'manager_employee_id');
    }

    public function profile(): HasOne
    {
        return $this->hasOne(EmployeeProfile::class);
    }

    public function departmentHistory(): HasMany
    {
        return $this->hasMany(EmployeeDepartment::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(EmployeeContract::class);
    }

    public function socialAccounts()
    {
        return $this->hasMany(\App\Models\EmployeeSocialAccount::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function managerUser()
    {
        return $this->manager?->user; // باستخدام relationship الحالي manager + user
    }

    /**
     * The Worklife groups that the employee belongs to.
     */
    public function worklifeGroups(): BelongsToMany
    {
        return $this->belongsToMany(WorklifeGroup::class, 'worklife_group_employee', 'employee_id', 'worklife_group_id')
            ->withTimestamps();
    }
}

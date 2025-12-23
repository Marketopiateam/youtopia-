<?php

namespace App\Models;

use App\Enums\OnboardingTaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnboardingTask extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'title',
        'description',
        'assigned_by_employee_id',
        'due_date',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'status' => OnboardingTaskStatus::class,
        'due_date' => 'date',
        'completed_at' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assigned_by_employee_id');
    }
}

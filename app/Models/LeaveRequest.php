<?php

namespace App\Models;

use App\Enums\LeaveStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'start_date',
        'end_date',
        'from_date',
        'to_date',
        'days_count',
        'reason',
        'status',
        'submitted_at',
    ];

    protected $casts = [
        'status' => LeaveStatus::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'days_count' => 'decimal:2',
        'submitted_at' => 'datetime',
    ];

    public function getFromDateAttribute(): mixed
    {
        return $this->start_date;
    }

    public function setFromDateAttribute(mixed $value): void
    {
        $this->attributes['start_date'] = $value;
    }

    public function getToDateAttribute(): mixed
    {
        return $this->end_date;
    }

    public function setToDateAttribute(mixed $value): void
    {
        $this->attributes['end_date'] = $value;
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function approvalRequest(): MorphOne
    {
        return $this->morphOne(ApprovalRequest::class, 'requestable');
    }

    protected static function booted(): void
    {
        static::created(function (LeaveRequest $leaveRequest) {
            event(new \App\Events\LeaveRequestSubmitted($leaveRequest));
        });
    }
}

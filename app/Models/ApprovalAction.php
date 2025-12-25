<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovalAction extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'approval_request_id',
        'step_id',
        'approver_employee_id',
        'action',
        'notes',
        'acted_at',
    ];

    protected $casts = [
        'action' => \App\Enums\ApprovalActionType::class,
        'acted_at' => 'datetime',
    ];

    public function approvalRequest(): BelongsTo
    {
        return $this->belongsTo(ApprovalRequest::class);
    }

    public function step(): BelongsTo
    {
        return $this->belongsTo(ApprovalStep::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'approver_employee_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovalStep extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'workflow_id',
        'step_order',
        'approver_type', // New field
        'approver_role',
        'approver_employee_id',
        'is_required',
    ];

    protected $casts = [
        'step_order' => 'integer',
        'is_required' => 'boolean',
        'approver_type' => \App\Enums\ApprovalApproverType::class, // New cast
    ];

    public function workflow(): BelongsTo
    {
        return $this->belongsTo(ApprovalWorkflow::class, 'workflow_id');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'approver_employee_id');
    }

    public function actions(): HasMany
    {
        return $this->hasMany(ApprovalAction::class, 'step_id');
    }
}

<?php

namespace App\Models;

use App\Enums\PayrollCycleStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayrollCycle extends Model
{
    protected $fillable = [
        'year',
        'month',
        'start_date',
        'end_date',
        'status',
        'processed_at',
        'processed_by_employee_id',
    ];

    protected $casts = [
        'status' => PayrollCycleStatus::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'processed_at' => 'datetime',
    ];

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'processed_by_employee_id');
    }

    public function payslips(): HasMany
    {
        return $this->hasMany(Payslip::class);
    }
}

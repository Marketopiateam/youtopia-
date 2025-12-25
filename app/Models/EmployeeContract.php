<?php

namespace App\Models;

use App\Enums\ContractType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeContract extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'contract_type',
        'start_date',
        'end_date',
        'probation_end_date',
        'working_hours_per_week',
        'base_salary',
        'terms',
    ];

    protected $casts = [
        'contract_type' => ContractType::class,
        'start_date' => 'date',
        'end_date' => 'date',
        'probation_end_date' => 'date',
        'terms' => 'array',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

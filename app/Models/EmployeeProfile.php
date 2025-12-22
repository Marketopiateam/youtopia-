<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeProfile extends Model
{
    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'national_id',
        'birth_date',
        'address',
        'emergency_contact_name',
        'emergency_contact_phone',
        'avatar_path',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }
}

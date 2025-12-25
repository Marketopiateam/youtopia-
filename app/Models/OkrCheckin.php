<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OkrCheckin extends Model
{
    use HasFactory;
    protected $fillable = [
        'key_result_id',
        'employee_id',
        'value',
        'notes',
        'checked_in_at',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'checked_in_at' => 'datetime',
    ];

    public function keyResult(): BelongsTo
    {
        return $this->belongsTo(OkrKeyResult::class, 'key_result_id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

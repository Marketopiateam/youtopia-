<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeerFeedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'reviewer_employee_id',
        'feedback_text',
        'rating',
        'is_anonymous',
        'submitted_at',
    ];

    protected $casts = [
        'rating' => 'decimal:2',
        'is_anonymous' => 'boolean',
        'submitted_at' => 'datetime',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'reviewer_employee_id');
    }
}

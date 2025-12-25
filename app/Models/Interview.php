<?php

namespace App\Models;

use App\Enums\InterviewStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interview extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'application_id',
        'scheduled_at',
        'location',
        'interview_type',
        'status',
        'notes',
    ];

    protected $casts = [
        'status' => InterviewStatus::class,
        'scheduled_at' => 'datetime',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class, 'application_id');
    }

    public function interviewers(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'interview_interviewers')
            ->withPivot(['feedback', 'rating'])
            ->withTimestamps();
    }
}

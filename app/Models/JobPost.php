<?php

namespace App\Models;

use App\Enums\JobPostStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'department_id',
        'created_by_employee_id',
        'url',
        'status',
        'published_at',
        'expires_at',
    ];

    protected $casts = [
        'status' => JobPostStatus::class,
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'created_by_employee_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    protected static function booted(): void
    {
        static::updated(function (JobPost $jobPost) {
            // Fire event when status changes to published
            if ($jobPost->isDirty('status') && $jobPost->status === JobPostStatus::Published) {
                event(new \App\Events\JobPostPublished($jobPost));
            }
        });
    }
}

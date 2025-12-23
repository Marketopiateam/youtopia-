<?php

namespace App\Models;

use App\Enums\AudienceType; // Reusing this enum for consistency
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'created_by_user_id',
        'target_scope',
        'target_scope_id',
        'publish_at',
        'expires_at',
        'is_active',
    ];

    protected $casts = [
        'target_scope' => AudienceType::class, // Reusing AudienceType enum
        'publish_at' => 'datetime',
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user who created the announcement.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    /**
     * Get the WorklifePost associated with this announcement.
     */
    public function worklifePost(): MorphOne
    {
        return $this->morphOne(WorklifePost::class, 'source');
    }

    /**
     * Get the target department if the announcement is department-scoped.
     */
    public function targetDepartment(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'target_scope_id');
    }

    /**
     * Scope a query to include only active announcements.
     * Active means published, not expired, and marked as active.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->whereNotNull('publish_at')
            ->where('publish_at', '<=', now())
            ->where(function (Builder $q) {
                $q->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    /**
     * Scope a query to include announcements visible to a specific employee.
     */
    public function scopeForEmployee(Builder $query, Employee $employee): Builder
    {
        return $query->where(function (Builder $q) use ($employee) {
            // Company-wide announcements
            $q->where('target_scope', AudienceType::Company)
                ->orWhere(function (Builder $q2) use ($employee) {
                    // Department-specific announcements
                    $q2->where('target_scope', AudienceType::Department)
                        ->where('target_scope_id', $employee->department_id); // Assuming employee has department_id
                })
                ->orWhere(function (Builder $q3) use ($employee) {
                    // Group-specific announcements
                    $q3->where('target_scope', AudienceType::Group)
                        ->whereHas('targetGroup', fn ($query) => $query->where('employee_id', $employee->id));
                });
        });
    }

    /**
     * Get the WorklifeGroup that this announcement is targeted to, if applicable.
     */
    public function targetGroup(): BelongsTo
    {
        return $this->belongsTo(WorklifeGroup::class, 'target_scope_id');
    }
}
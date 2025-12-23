<?php

namespace App\Models;

use App\Enums\AudienceType;
use App\Enums\VoteStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'created_by_employee_id',
        'audience_type',
        'audience_id',
        'starts_at',
        'ends_at',
        'is_anonymous',
        'status',
    ];

    protected $casts = [
        'audience_type' => AudienceType::class,
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_anonymous' => 'boolean',
        'status' => VoteStatus::class,
    ];

    /**
     * Get the employee who created the vote.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'created_by_employee_id');
    }

    /**
     * Get the options for the vote.
     */
    public function options(): HasMany
    {
        return $this->hasMany(VoteOption::class);
    }

    /**
     * Get the ballots cast for this vote.
     */
    public function ballots(): HasMany
    {
        return $this->hasMany(VoteBallot::class);
    }

    /**
     * Get the WorklifePost associated with this vote.
     */
    public function worklifePost(): MorphOne
    {
        return $this->morphOne(WorklifePost::class, 'source');
    }

    /**
     * Scope a query to include only published votes that are currently active.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', VoteStatus::Published)
            ->whereNotNull('starts_at')
            ->where('starts_at', '<=', now())
            ->where(function (Builder $q) {
                $q->whereNull('ends_at')
                    ->orWhere('ends_at', '>', now());
            });
    }

    /**
     * Scope a query to include only closed votes.
     */
    public function scopeClosed(Builder $query): Builder
    {
        return $query->where('status', VoteStatus::Closed)
            ->orWhere(function (Builder $q) {
                $q->whereNotNull('ends_at')
                    ->where('ends_at', '<=', now());
            });
    }

    /**
     * Scope a query to include votes visible to a specific employee.
     */
    public function scopeForEmployee(Builder $query, Employee $employee): Builder
    {
        return $query->where(function (Builder $q) use ($employee) {
            // Company-wide votes
            $q->where('audience_type', AudienceType::Company)
                ->orWhere(function (Builder $q2) use ($employee) {
                    // Department-specific votes
                    $q2->where('audience_type', AudienceType::Department)
                        ->where('audience_id', $employee->department_id); // Assuming employee has department_id
                })
                ->orWhere(function (Builder $q3) use ($employee) {
                    // Group-specific votes
                    $q3->where('audience_type', AudienceType::Group)
                        ->whereHas('audienceGroup', fn ($query) => $query->where('employee_id', $employee->id));
                });
        });
    }

    /**
     * Get the WorklifeGroup that this vote is targeted to, if applicable.
     */
    public function audienceGroup(): BelongsTo
    {
        return $this->belongsTo(WorklifeGroup::class, 'audience_id');
    }
}
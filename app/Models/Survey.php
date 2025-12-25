<?php

namespace App\Models;

use App\Enums\AudienceType;
use App\Enums\SurveyStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes;
    use HasFactory;

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
        'status' => SurveyStatus::class,
    ];

    /**
     * Get the employee who created the survey.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'created_by_employee_id');
    }

    /**
     * Get the questions for the survey.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(SurveyQuestion::class);
    }

    /**
     * Get the responses to the survey.
     */
    public function responses(): HasMany
    {
        return $this->hasMany(SurveyResponse::class);
    }

    /**
     * Get the WorklifePost associated with this survey.
     */
    public function worklifePost(): MorphOne
    {
        return $this->morphOne(WorklifePost::class, 'source');
    }

    /**
     * Scope a query to include only published surveys that are currently active.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', SurveyStatus::Published)
            ->whereNotNull('starts_at')
            ->where('starts_at', '<=', now())
            ->where(function (Builder $q) {
                $q->whereNull('ends_at')
                    ->orWhere('ends_at', '>', now());
            });
    }

    /**
     * Scope a query to include only closed surveys.
     */
    public function scopeClosed(Builder $query): Builder
    {
        return $query->where('status', SurveyStatus::Closed)
            ->orWhere(function (Builder $q) {
                $q->whereNotNull('ends_at')
                    ->where('ends_at', '<=', now());
            });
    }

    /**
     * Scope a query to include surveys visible to a specific employee.
     */
    public function scopeForEmployee(Builder $query, Employee $employee): Builder
    {
        return $query->where(function (Builder $q) use ($employee) {
            // Company-wide surveys
            $q->where('audience_type', AudienceType::Company)
                ->orWhere(function (Builder $q2) use ($employee) {
                    // Department-specific surveys
                    $q2->where('audience_type', AudienceType::Department)
                        ->where('audience_id', $employee->department_id); // Assuming employee has department_id
                })
                ->orWhere(function (Builder $q3) use ($employee) {
                    // Group-specific surveys
                    $q3->where('audience_type', AudienceType::Group)
                        ->whereHas('audienceGroup', fn ($query) => $query->where('employee_id', $employee->id));
                });
        });
    }

    /**
     * Get the WorklifeGroup that this survey is targeted to, if applicable.
     */
    public function audienceGroup(): BelongsTo
    {
        return $this->belongsTo(WorklifeGroup::class, 'audience_id');
    }
}

<?php

namespace App\Models;

use App\Enums\AudienceType;
use App\Enums\WorklifePostType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorklifePost extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'author_employee_id',
        'source_type',
        'source_id',
        'post_type',
        'content',
        'audience_type',
        'audience_id',
        'is_pinned',
        'published_at',
    ];

    protected $casts = [
        'post_type' => WorklifePostType::class,
        'audience_type' => AudienceType::class,
        'is_pinned' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * The author of the worklife post.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'author_employee_id');
    }

    /**
     * Get the parent source model (e.g., Announcement, Survey, Vote) for the post.
     */
    public function source(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the comments for the worklife post.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(WorklifeComment::class);
    }

    /**
     * Get the reactions for the worklife post.
     */
    public function reactions(): MorphMany
    {
        return $this->morphMany(WorklifeReaction::class, 'reactable');
    }

    /**
     * Get the attachments for the worklife post.
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(WorklifeAttachment::class, 'attachable');
    }

    /**
     * Get the WorklifeGroup that this post is targeted to, if applicable.
     */
    public function audienceGroup(): BelongsTo
    {
        return $this->belongsTo(WorklifeGroup::class, 'audience_id');
    }

    /**
     * Scope a query to include only published posts.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to include only pinned posts.
     */
    public function scopePinned(Builder $query): Builder
    {
        return $query->where('is_pinned', true);
    }

    /**
     * Scope a query to include only active (published and not deleted) posts.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->published()->whereNull('deleted_at');
    }

    /**
     * Scope a query to include posts of a specific type.
     */
    public function scopeOfType(Builder $query, WorklifePostType $type): Builder
    {
        return $query->where('post_type', $type);
    }

    /**
     * Scope a query to include posts visible to a specific employee.
     * This implements the audience system logic.
     */
    public function scopeVisibleTo(Builder $query, Employee $employee): Builder
    {
        return $query->where(function (Builder $q) use ($employee) {
            // Company-wide posts
            $q->where('audience_type', AudienceType::Company)
                ->orWhere(function (Builder $q2) use ($employee) {
                    // Department-specific posts
                    $q2->where('audience_type', AudienceType::Department)
                        ->where('audience_id', $employee->department_id); // Assuming employee has department_id
                })
                ->orWhere(function (Builder $q3) use ($employee) {
                    // Group-specific posts (requires employee to belong to the audience_id group)
                    $q3->where('audience_type', AudienceType::Group)
                        ->whereIn('audience_id', function ($subQuery) use ($employee) {
                            $subQuery->select('worklife_group_id')
                                ->from('worklife_group_employee')
                                ->where('employee_id', $employee->id);
                        });
                })
                ->orWhere(function (Builder $q4) use ($employee) {
                    // Direct posts (i.e., private message or direct assignment, audience_id refers to employee_id)
                    $q4->where('audience_type', AudienceType::Direct)
                        ->where('audience_id', $employee->id);
                })
                ->orWhere(function (Builder $q5) use ($employee) {
                    // Posts authored by the employee are always visible to them, regardless of audience
                    $q5->where('author_employee_id', $employee->id);
                });
        });
    }
}
